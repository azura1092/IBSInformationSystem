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
use App\CourseOffering;


Class CourseOfferingCsvController extends MainController 
{
    //This is where the file is being retrieved and stored in server temporarily to get the data.
    public function storeCourseOffering()
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
                $section[$i] = $info[1];
                $lecture[$i] = $info[2];
                $lecturer[$i] = $info[3];
                $lab[$i] = $info[4];
                $labinstruct[$i] = $info[5];
                $i++;
            }

            fclose($fil);
            $rows = 0;
            
            for($i=0; $i<count($courseNum); $i++)
            {
                $rows = $rows + CourseOfferingCsvController::storeToDb($courseNum[$i],$section[$i], $lecture[$i], $lecturer[$i], $lab[$i], $labinstruct[$i]);
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

        parent::log('UP', 'Uploaded list of Course Offerings.');

        return redirect('course-upload-bulk-data');
    }
   
    public function storeToDb($courseNum,$section, $lecture, $lecturer, $lab, $labinstruct)
    {
        $regCourseNum = preg_match("/[A-Za-z]{3,4}\s[0-9]{1,3}(\s\([A-Za-z]{3}\))?/", $courseNum);
        $regsection = preg_match("/[A-Za-z]+-\d\w/", $section);
        


        $results = Course::where('courseNum', '=', $courseNum)->get();

        if(COUNT($results) > 0){

            if( $regCourseNum && $regsection )
            {
                $results = CourseOffering::where('courseNum', '=', $courseNum)->get();
                $sectExist = 0;
                foreach ($results as $r) {
                    if($r->section == $section){
                        echo $r->section;
                        $sectExist = 1;
                        break;
                    }
                    else $sectExist = 0;
                }

                if($sectExist == 0){
                     CourseOffering::create
                        ([
                          'courseNum'=>$courseNum,
                          'section'=>$section,
                          'lecture'=>$lecture,
                          'lecturer'=>$lecturer,
                          'lab'=>$lab,
                          'labinstruct'=>$labinstruct,
                        ]);

                    return 1;
                }
            }
            return 0;
        }
        return 0;
    }

}