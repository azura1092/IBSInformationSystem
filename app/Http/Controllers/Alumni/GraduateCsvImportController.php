<?php namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use DB;
use Input;
use Validator;
use Session;

use App\Graduate;
use App\UploadBulkLogs;


Class GraduateCsvImportController extends Controller {

    //This is where the file is being retrieved and stored in server temporarily to get the data.
    public function store(){
        $file = Request::file('fileToUpload');                         //get the file as a .tmp -->like a hashed fileName
        
        $extension = null;
        if($file != null){
            $trueFileName = $file->getClientOriginalName();             //get the true file name, not the .tmp file 
            $extension = File::extension($trueFileName);
        }
        else{
            $message = "No file selected.";
            $status = 0;
        }

        if ($extension == 'csv'){                                       //to validate if the file being uploaded is a .csv file.
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
            foreach ($information as $info) {
                $studnum[$i] = $info[0];
                $fname[$i] = $info[1];
                $mname[$i] = $info[2];
                $lname[$i] = $info[3];
                $suffix[$i] = $info[4];
                $bday[$i] = $info[5];
                $sex[$i] = date('Y-m-d', strtotime($info[6]));
                $contactnum[$i] = $info[7];
                $permaddress[$i] = $info[8];
                $curraddress[$i] = $info[9];
                $major[$i] = $info[10];
                $mscdegree[$i] = $info[11];
                $yeargrad[$i] = $info[12];
                $honorsreceived[$i] = $info[13];
                $companyname[$i] = $info[14];
                $position[$i] = $info[15];
                $natureofwork[$i] = $info[16];
                $companyaddress[$i] = $info[17];
                $country[$i] = $info[18];
                $companyemail[$i] = $info[19];
                $companycontactnum[$i] = $info[20];
                $i++;
            }

            fclose($fil);
            $rows = 0;
            
            for($i=1; $i<count($studnum)-1; $i++){
                $rows = $rows + GraduateCsvImportController::storeToDb($studnum[$i], $fname[$i], $mname[$i], $lname[$i], $suffix[$i], $bday[$i], $sex[$i], $contactnum[$i], $permaddress[$i], $curraddress[$i], $major[$i], $mscdegree[$i], $yeargrad[$i], $honorsreceived[$i], $companyname[$i], $position[$i], $natureofwork[$i], $companyaddress[$i], $country[$i], $companyemail[$i], $companycontactnum[$i]);
            }

            $message = "Successfully added ".$rows."  rows.";
            $status = 1;
        }

        else{                                                           //file is not a .csv or there was no file selected at all.
            
            if(isset($trueFileName)){                                   //file is not a .csv
                $message = " ".$trueFileName." is not a .csv file.";
                $status = 2;
            }
            else{                                                       //no file selected
                $data['success'] = false;
            }
        }

        Session::put('message', $message);
        Session::put('status', $status);
        $logId = 'UP'.count(UploadBulkLogs::all()); //generates the log id
        UploadBulkLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']); //adds the log in the database
        
        
        return redirect('graduate-upload-bulk-data');
    }
   
    public function storeToDb($studnum, $fname, $mname, $lname, $suffix, $bday, $sex, $contactnum, $permaddress, $curraddress, $major, $mscdegree, $yeargrad, $honorsreceived, $companyname, $position, $natureofwork, $companyaddress, $country, $companyemail, $companycontactnum){
        
        $results = Graduate::where('studnum', '=', $studnum)->get();
        if(COUNT($results) == 0){

            Graduate::create(['studnum'=>$studnum,
                'fname'=>$fname,
                'mname'=>$mname,
                'lname'=>$lname,
                'suffix'=>$suffix,
                'bday'=>$bday,
                'sex'=>$sex,
                'contactnum'=>$contactnum,
                'permaddress'=>$permaddress,
                'curraddress'=>$curraddress,
                'major'=>$major,
                'mscdegree'=>$mscdegree,
                'yeargrad'=>$yeargrad,
                'honorsreceived'=>$honorsreceived,
                'companyname'=>$companyname,
                'position'=>$position,
                'natureofwork'=>$natureofwork,
                'companyaddress'=>$companyaddress,
                'country'=>$country,
                'companyemail'=>$companyemail,
                'companycontactnum'=>$companycontactnum]);
            return 1;

        }

        return 0;
      
    }
}
