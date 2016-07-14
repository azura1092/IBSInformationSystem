<?php namespace App\Http\Controllers\FacultyAndStaff;

use App\Http\Controllers\MainController;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use DB;
use Input;
use Validator;
use Session;

use App\Course;


Class CourseCsvImportController extends MainController 
{
    //This is where the file is being retrieved and stored in server temporarily to get the data.
    public function store()
    {
        $file = Request::file('fileToUpload');                         //get the file as a .tmp -->like a hashed fileName
        
        $extension = null;

        if($file != null)
        {
            $trueFileName = $file->getClientOriginalName();             //get the true file name, not the .tmp file 
            $extension = File::extension($trueFileName);
        }
        else
        {
            $message = "No file selected.";
            $status = 0;
        }

        if ($extension == 'csv')
        {                                       //to validate if the file being uploaded is a .csv file.
            $fileName = $file->getFilename().'.'.$trueFileName;         //create string with the name of the file plus its extension
            Storage::disk('local')->put( $fileName, File::get($file));  //store into storage/app
            $contents = Storage::get($fileName);                        //read the contents of the uploaded file    

            $fil = fopen($file,"r");

            $i=0;

            while(! feof($fil))
            {
                //print_r(fgetcsv($fil));
                $information[$i] = fgetcsv($fil);
                $i++;
            }

            $i = 0;

            foreach ($information as $info) 
            {
                $courseNum[$i] = $info[0];
                $courseTitle[$i] = $info[1];
                $classification[$i] = $info[2];
                $semOffered[$i] = $info[3];
                $prerequisite[$i] = $info[4];
                $numOfUnits[$i] = $info[5];
                $i++;
            }

            fclose($fil);
            $rows = 0;
            
            for($i=1; $i<count($courseNum)-1; $i++)
            {
                $rows = $rows + CourseCsvImportController::storeToDb($courseNum[$i],$courseTitle[$i], $classification[$i], $semOffered[$i], $prerequisite[$i], $numOfUnits[$i]);
            }

            $message = "Successfully added ".$rows."  rows.";
            $status = 1;
        }
        else
        {                                                           //file is not a .csv or there was no file selected at all.
            
            if(isset($trueFileName))
            {                                   //file is not a .csv
                $message = " ".$trueFileName." is not a .csv file.";
                $status = 2;
            }
            else
            {                                                       //no file selected
                $data['success'] = false;
            }
        }

        Session::put('message', $message);
        Session::put('status', $status);

        parent::log('UP', 'Uploaded list of Courses.');

        return redirect('course-upload-bulk-data');
    }
   
    public function storeToDb($courseNum,$courseTitle, $classification, $semOffered, $prerequisite, $numOfUnits)
    {
        $regCourseNum = preg_match("/^[A-Za-z]{3,4}\s[0-9]{1,3}$/", $courseNum);
        $regCourseTitle = preg_match("/^[A-Za-z]{1,}.{1,}[a-z]{1,}$/", $courseTitle);
        $regPrerequisite = preg_match("/^[A-Z]{3,4}\s[0-9]{1,3}$/", $prerequisite);
        


        $results = Course::where('courseNum', '=', $courseNum)->get();
        if(COUNT($results) == 0){
            if( $regCourseNum && $regCourseTitle 
                && ($classification == 'Undergraduate' || $classification == 'Graduate' ) 
                && ($semOffered == 1 || $semOffered == 2 || $semOffered == '1,2' || $semOffered == 'midyear') 
                && ($regPrerequisite || $prerequisite == ' ') 
                && ($numOfUnits >= 0 && $numOfUnits <= 5))
            {

                Course::create
                ([
                    'courseNum'=>$courseNum,
                    'courseTitle'=>$courseTitle,
                    'classification'=>$classification,
                    'semOffered'=>$semOffered,
                    'prerequisite'=>$prerequisite,
                    'numOfUnits'=>$numOfUnits,
                ]);

                return 1;
            }
            return 0;
        }
        return 0;
    }
}
