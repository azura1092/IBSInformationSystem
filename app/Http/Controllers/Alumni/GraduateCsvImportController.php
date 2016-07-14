<?php namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\MainController;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use DB;
use Input;
use Validator;
use Session;

use App\Graduate;


Class GraduateCsvImportController extends MainController 
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
                $studnum[$i] = $info[0];
                $fname[$i] = $info[1];
                $lname[$i] = $info[2];
                $suffix[$i] = $info[3];
                $mname[$i] = $info[4];
                $bday[$i] = date('Y-m-d', strtotime($info[5])); 
                $sex[$i] = $info[6];
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
            
            for($i=1; $i<count($studnum)-1; $i++)
            {
                $rows = $rows + GraduateCsvImportController::storeToDb($studnum[$i], $fname[$i], $lname[$i], $suffix[$i], $mname[$i], $bday[$i], $sex[$i], $contactnum[$i], $permaddress[$i], $curraddress[$i], $major[$i], $mscdegree[$i], $yeargrad[$i], $honorsreceived[$i], $companyname[$i], $companyaddress[$i], $companyemail[$i], $companycontactnum[$i], $position[$i], $natureofwork[$i], $country[$i]);
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

        parent::log('UP', 'Uploaded list of alumni.');

        return redirect('graduate-upload-bulk-data');
    }
   
    public function storeToDb($studnum, $fname, $lname, $mname, $suffix, $bday, $sex, $contactnum, $permaddress, $curraddress, $major, $mscdegree, $yeargrad, $honorsreceived, $companyname, $companyaddress, $companyemail, $companycontactnum, $position, $natureofwork, $country)
    {
        $regStudnum = preg_match("/^[1-2][0-9]{3}-[0-9]{5}$/", $studnum);
        $regFname = preg_match("/^[A-Za-z]{0,}[\s[A-Za-z]{1,}]{0,}$/", $fname);
        $regLname = preg_match("/^[A-Za-z]{0,}[\s[A-Za-z]{1,}]{0,}$/", $lname);
        $regMname = preg_match("/^[A-Za-z]{0,}[\s[A-Za-z]{1,}]{0,}$/", $mname);
        //$regSuffix = preg_match("/^[A-Z][a-z]{1,}[\s[A-Z][a-z]{1,}]{0,}$/", $suffix);
        $regBday = preg_match("/^(19|20)[0-9]{2}\-(0[1-9]|1[0-2])\-(0[1-9]|1[0-9]|2[0-9]|3[01])$/", $bday);
        $regContactNum = preg_match("/^[9][0-9]{9,9}$/", $contactnum);
        $regPermanentAddress = preg_match("/.{3,}/", $permaddress);
        $regCurrentAddress = preg_match("/.{3,}/", $curraddress);
        $regMajor = preg_match("/^[A-Za-z]{1,1}.{1,}@[a-z]{1,}\.[a-z]{1,}$/", $major);
        $regMscdegree = preg_match("/^[0-9]{9,9}$/", $mscdegree);
        //$regYeargrad = preg_match("/^[A-Za-z]{1,}.{1,}[a-z]{1,}$/", $yeargrad);
        $regHonorsreceived = preg_match("/^.{0,}$/", $honorsreceived);
        $regCompanyname = preg_match("/^.{1,}$/", $companyname);
        
        $regCompanyaddress = preg_match("/^.{3,}$/", $companyaddress);
        $regCompanyemail = preg_match("/^[A-Za-z]{1,1}.{1,}@[A-Za-z]{1,}\.[A-Za-z]{1,}$/", $companyemail);
        $regCompanycontactnum = preg_match("/^[9][0-9]{9,9}$/", $contactnum);
        $regPosition = preg_match("/.{5,}/", $position);
        $regNatureofwork = preg_match("/.{5,}/", $natureofwork);
        $regCountry = preg_match("/.{5,}/", $country);
        
        
        $results = Graduate::where('studnum', '=', $studnum)->get();
        if(COUNT($results) == 0){

            if( 
                $regStudnum
                && $regFname
                && $regLname
                && ($regSuffix = 'Jr.' || $regSuffix = 'Ma.' || $regSuffix = 'N/A')
                && $regMname
                && $regBday
                && ($sex == 'male' || $sex == 'female')
                && $regContactNum
                && $regPermanentAddress
                && $regCurrentAddress
                && ($major == 'Cell and Molecular Biology' || $major == 'Ecology' || $major == 'Genetics' || $major == 'Microbiology' || $major == 'Plant Biology' || $major == 'Systematics' || $major == 'Wildlife Biology' || $major == 'Zoology' )
                && ($mscdegree == 'N/A' || $mscdegree == 'Botany' || $mscdegree == 'Genetics' || $mscdegree == 'Microbiology' || $mscdegree == 'Molecular Biology and Biotechnology' || $mscdegree == 'Wildlife Studies' || $mscdegree == 'Zoology')
                && $yeargrad > 1983
                && $regHonorsreceived
                && $regCompanyname
                && $regCompanyaddress
                && $regCompanyemail
                && $regCompanycontactnum
                && $regPosition
                && $regNatureofwork
                && $regCountry

            )
            {

                Graduate::create
                ([
                    'studnum'=>$studnum,
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'suffix'=>$suffix,
                    'mname'=>$mname,
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
                    'companyaddress'=>$companyaddress,
                    'companyemail'=>$companyemail,
                    'companycontactnum'=>$companycontactnum,
                    'position'=>$position,
                    'natureofwork'=>$natureofwork,
                    'country'=>$country,
                ]);

                return 1;
            }
        }

        return 0;
    }
}
