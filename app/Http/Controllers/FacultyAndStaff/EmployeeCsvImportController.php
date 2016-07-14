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

use App\Employees;
use App\FacultyPosition;
use App\StaffPosition;
use App\Degree;
use App\Division;
use App\Specialization;

Class EmployeeCsvImportController extends MainController 
{
    //This is where the file is being retrieved and stored in server temporarily to get the data.
    public function store()
    {
        if(Session::has('type'))
        {
            if(Session::get('type') == 2)
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
                {       
                    $fil = fopen($file,"r");

                    $i=0;
                    while(! feof($fil))
                    {
                        //print_r(fgetcsv($fil));
                        $information[$i] = fgetcsv($fil);
                        $i++;
                    }

                    //foreach ($information as $info) {
                    for($i=0; $i<count($information)-1; $i++)
                    {
                        if(count($information[$i]) != 17)
                        {
                            $temp = $i+1;
                            Session::put('error', 'Error in adding row '.$temp.'. Incorrect number of columns.');
                            return redirect('employee-upload-bulk-data');
                        }

                        $info = $information[$i];
                        $employeeNum[$i] = $info[0];
                        $type[$i] = $info[1];
                        $firstName[$i] = $info[2];
                        $middleName[$i] = $info[3];
                        $lastName[$i] = $info[4];
                        $sex[$i] = $info[5];
                        $birthdate[$i] = date('Y-m-d', strtotime($info[6]));
                        $position[$i] = $info[7];
                        $division[$i] = $info[8];
                        $contactNum[$i] = $info[9];
                        $emailAddress[$i] = $info[10];
                        $currentAddress[$i] = $info[11];
                        $permanentAddress[$i] = $info[12];
                        $degree[$i] = $info[13];
                        $specialization[$i] = $info[14];
                        $schoolGraduated[$i] = $info[15];
                        $yearGraduated[$i] = $info[16];
                    }

                    fclose($fil);
                    $rows = 0;

                    for($i=1; $i<count($employeeNum); $i++)
                    {
                        if($employeeNum[$i] == "")
                        {
                            $temp = $i+1;
                            Session::put('error', 'Error in row '.$temp.'. Employee number cannot be null');
                            return redirect('employee-upload-bulk-data');
                        }

                        $rows = $rows + EmployeeCsvImportController::storeToDb($employeeNum[$i], $type[$i], $firstName[$i], $middleName[$i], $lastName[$i], $sex[$i], $birthdate[$i], $position[$i], $division[$i], $contactNum[$i], $emailAddress[$i], $currentAddress[$i], $permanentAddress[$i], $degree[$i], $specialization[$i], $schoolGraduated[$i], $yearGraduated[$i]);
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

                parent::log('UP', 'Uploaded list of employees.');

                Session::put('message', $message);
                Session::put('status', $status);

                return redirect('employee-upload-bulk-data');
            }
        }

        return redirect('login');
    }
  


    public function storeToDb($employeeNum, $type, $firstName, $middleName, $lastName, $sex, $birthdate, $position, $division, $contactNum, $emailAddress, $currentAddress, $permanentAddress, $degree, $specialization, $schoolGraduated, $yearGraduated)
    {
        if(Session::has('type'))
        {
                 
            $regEmployeeNum = preg_match("/^[0-9]{9,9}$/", $employeeNum);
            $regFirstName = preg_match("/^[A-Z][A-Za-z]{1,}[\s[A-Z][A-Za-z]{1,}]{0,}$/", $firstName);
            $regMiddleName = preg_match("/^[A-Z]{0,1}[A-Za-z]{0,}[\s[A-Z][A-Za-z]{0,}]{0,}$/", $middleName);
            $regLastName = preg_match("/^[A-Z][A-Za-z]{1,}[\s[A-Z][A-Za-z]{1,}]{0,}$/", $lastName);
            $regBirthdate = preg_match("/^(19|20)[0-9]{2}\-(0[1-9]|1[0-2])\-(0[1-9]|1[0-9]|2[0-9]|3[01])$/", $birthdate);
            $regContactNum = preg_match("/^[0][9][0-9]{9,9}$/", $contactNum);
            $regEmailAddress = preg_match("/^[A-Za-z]{1,1}.{1,}@[A-Za-z]{1,}\.[A-Za-z]{1,}$/", $emailAddress);
            $regCurrentAddress = preg_match("/.{3,}/", $currentAddress);
            $regPermanentAddress = preg_match("/.{3,}/", $permanentAddress);
            $regSchoolGraduated = preg_match("/.{3,}/", $schoolGraduated);
           
            $results = Employees::where('employeeNum', '=', $employeeNum)->get();
            $resultsEmail = Employees::where('emailAddress', '=', $emailAddress)->get();
            $resultsFacultyPosition = FacultyPosition::where('positionTitle', '=', $position)->get();
            $resultsStaffPosition = StaffPosition::where('positionTitle', '=', $position)->get();
            $resultsDivision = Division::where('division', '=', $division)->get();
            $resultsDegree = Degree::where('degree', '=', $degree)->get();
            $resultsSpecialization = Specialization::where('specialization', '=', $specialization)->get();
            

            if(COUNT($results) == 0 && COUNT($resultsEmail) == 0)
            {
                if( 
                    $regEmployeeNum 
                    && $regFirstName 
                    && $regMiddleName 
                    && $regLastName 
                    && $regBirthdate 
                    && $regContactNum 
                    && $regEmailAddress 
                    && $regCurrentAddress 
                    && $regPermanentAddress 
                    && $regSchoolGraduated 
                    && ($type == 0 || $type == 1 || $type == 2)
                    && ($sex == 'M' || $sex == 'F' )
                    && ($yearGraduated >= 1950)
                    && (COUNT($resultsFacultyPosition) > 0 || COUNT($resultsStaffPosition) > 0 ) 
                    && COUNT($resultsDivision) > 0
                    && COUNT($resultsDegree) > 0
                    && COUNT($resultsSpecialization) > 0
                )


                {
                    Employees::create
                    ([
                        'employeeNum' => $employeeNum, 
                        'type' => $type, 
                        'firstName' => $firstName,
                        'middleName' => $middleName, 
                        'lastName' => $lastName, 
                        'sex' => $sex, 
                        'birthdatdivisione' => $birthdate, 
                        'position' => $position, 
                        'division' => $division ,
                        'contactNum' => $contactNum, 
                        'emailAddress' => $emailAddress, 
                        'currentAddress' => $currentAddress, 
                        'permanentAddress' => $permanentAddress, 
                        'degree' => $degree, 
                        'specialization' => $specialization, 
                        'schoolGraduated' => $schoolGraduated, 
                        'yearGraduated' => $yearGraduated
                    ]);
                    
                    return 1;
                }
                return 0;
            }

            return 0;            
        }

    }
}
