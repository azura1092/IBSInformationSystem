<?php namespace App\Http\Controllers\FacultyAndStaff;

/*****************************************************************************
	This controller is for functionalities belonging to the administrator side.
	This allows the approval of sent requests by the user and whatnot.
******************************************************************************/

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use Redirect;
use File;

use Input;
use Log;
use DB;

use App\PDF;

use App\Employees;
use App\Course;
use App\Degree;
use App\Division;
use App\FacultyPosition;
use App\StaffPosition;
use App\Specialization;
use App\ArchivedProfile;
use App\UploadedRecords;
use App\EditRequest;
use App\ApprovedRequest;
use App\DeclinedRequest;
use App\EditNotice;
use App\AddFacultyLogs;
use App\AddStaffLogs;
use App\AddCourseLogs;
use App\EditStaffLogs;
use App\EditCourseLogs;
use App\DeleteStaffLogs;
use App\DeleteCourseLogs;
use App\ArchiveLogs;

class AdminController extends Controller 
{
	public function index() 
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				
				return view('facultyandstaff.admin.admin-home', compact('editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');
		
		return redirect('login');
	}

	public function addFacultyEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$temp = Session::get('temp');
				$type = 1;	//type 1: faculty

				$positions = FacultyPosition::all();
				$divisions = Division::all();
				$degrees = Degree::all();
				$specializations = Specialization::all();

				if(Session::has('temp'))
				{
					$status = $temp;
					Session::forget('temp');
				}
				else
				{
					$status = 1;
				}

				return view('facultyandstaff.admin.add-faculty-employee', compact('status', 'positions', 'divisions', 'degrees', 'specializations', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');
		
		return redirect('login');
	}

	public function addStaffEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$temp = Session::get('temp');
				$type = 0;	//type 0: staff

				$positions = StaffPosition::all();

				if(Session::has('temp'))
				{
					$status = $temp;
					Session::forget('temp');
				}
				else
				{
					$status = 1;
				}

				return view('facultyandstaff.admin.add-staff-employee', compact('status', 'positions', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processAddFacultyEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				global $temp;
				$type = 1;
				$employeeNumber = Input::get('employeeNumber');
				$firstName = Input::get('firstName');
				$middleName = Input::get('middleName');
				$lastName = Input::get('lastName');
				$sex = Input::get('sex');
				$birthdate = Input::get('birthdate');
				$position = Input::get('position');
				$division = Input::get('division');
				$contactNumber = Input::get('contactNumber');
				$emailAddress = Input::get('emailAddress');
				$currentAddress = Input::get('currentAddress');
				$permanentAddress = Input::get('permanentAddress');
				$degree = Input::get('degree');
				$specialization = Input::get('specialization');
				$yearGraduated = Input::get('yearGraduated');
				$school = Input::get('school');

				$username = $firstName + $lastName;

				//catch case where employee number already exists
				if((Employees::where('employeeNum', '=', $employeeNumber)->count()) > 0)
				{
					Session::put('temp', 0);
					return redirect('add-faculty-employee');
				}
				
				//adds the employee in the database
				Employees::create(['employeeNum' => $employeeNumber, 'type' => $type, 'firstName' => $firstName, 'middleName' => $middleName, 'lastName' => $lastName, 'sex' => $sex, 'birthdate' => $birthdate, 'position' => $position, 'division' => $division ,'contactNum' => $contactNumber, 'emailAddress' => $emailAddress, 'currentAddress' => $currentAddress, 'permanentAddress' => $permanentAddress, 'degree' => $degree, 'specialization' => $specialization, 'schoolGraduated' => $school, 'yearGraduated' => $yearGraduated, 'username' => $username]);	

				$temp .= 2;
				Session::put('temp', 2);

				//generates the log id
				$logId = 'ADF'.count(AddFacultyLogs::all());	

				//adds the log in the database
				AddFacultyLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	
		
				return redirect('add-faculty-employee');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processAddStaffEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				global $temp;
				$type = 0;
				$employeeNumber = Input::get('employeeNumber');
				$firstName = Input::get('firstName');
				$middleName = Input::get('middleName');
				$lastName = Input::get('lastName');
				$sex = Input::get('sex');
				$birthdate = Input::get('birthdate');
				$position = Input::get('position');
				$contactNumber = Input::get('contactNumber');
				$emailAddress = Input::get('emailAddress');
				$currentAddress = Input::get('currentAddress');
				$permanentAddress = Input::get('permanentAddress');

				$username = $firstName + $lastName;

				//catch case where employee number already exists
				if((Employees::where('employeeNum', '=', $employeeNumber)->count()) > 0)
				{
					Session::put('temp', 0);
					return redirect('add-staff-employee');
				}

				//adds the employee in the database
				Employees::create(['employeeNum' => $employeeNumber, 'type' => $type, 'firstName' => $firstName, 'middleName' => $middleName, 'lastName' => $lastName, 'sex' => $sex, 'birthdate' => $birthdate, 'position' => $position, 'contactNum' => $contactNumber, 'emailAddress' => $emailAddress, 'currentAddress' => $currentAddress, 'permanentAddress' => $permanentAddress, 'username' => $username]);	

				$temp .= 2;
				Session::put('temp',2);

				$logId = 'ADS'.count(AddStaffLogs::all());	//generates the log id
				AddStaffLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	//adds the log in the database
		
				return redirect('add-staff-employee');
			}
		}

		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function uploadEmployeeBulkData()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$message = "";
				$status = -1;
				$error = "";

				if(Session::has('message'))
				{
					$message = Session::get('message');
					Session::forget('message');
				}

				if(Session::has('status'))
				{
					$status = Session::get('status');
					Session::forget('status');
				}

				if(Session::has('error'))
				{
					$error = Session::get('error');
					Session::forget('error');
				}

				return view('facultyandstaff.admin.employee-upload-bulk-data', compact('message', 'status', 'error', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');
		
		return redirect('login');
	}

	public function searchEmployee($type)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();

				if(Session::has('deleteStatus'))
				{
					$deleteStatus = true;
					Session::forget('deleteStatus');
				}
				else
				{
					$deleteStatus = false;
				}

				if(Session::has('archiveStatus'))
				{
					$archiveStatus = true;
					Session::forget('archiveStatus');
				}
				else
				{
					$archiveStatus = false;
				}

				if(Session::has('retrieveStatus'))
				{
					$retrieveStatus = true;
					Session::forget('retrieveStatus');
				}
				else
				{
					$retrieveStatus = false;
				}

				$employees = Employees::orderBy('lastName', 'asc')->get();
				
				if($type == "id")
				{
					$employeeNum = Input::get('employeeNum');
					$employees = Employees::where('employeeNum', '=', $employeeNum)->get();
					$status = false;
				}

				else if($type == "lastname")
				{
					$lastName = Input::get('lastName');
					$employees = Employees::where('lastName', '=', $lastName)->get();
					$status = false;
				}

				else if($type == "position")
				{
					$position = Input::get('position');
					$employees = Employees::where('position', '=', $position)->get();
					$status = false;
				}

				else if($type == "division")
				{
					$division = Input::get('division');
					$employees = Employeess::where('division', '=', $division)->get();
					$status = false;
				}

				return view('facultyandstaff.admin.search-employee', compact('employees', 'deleteStatus', 'archiveStatus', 'retrieveStatus', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function editEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$facultypositions = FacultyPosition::all();
				$staffpositions = StaffPosition::all();
				$divisions = Division::all();
				$degrees = Degree::all();
				$specializations = Specialization::all();

				if(Input::has('employeeNum'))
				{
					Session::forget('editStatus');
					Session::forget('editEmployeeID');

					$eNum = Input::get('employeeNum');
					$employee = Employees::where('employeeNum', '=', $eNum)->get();
					$status = false;
					Session::put('editStatus', false);
					Session::put('editEmployeeID', $eNum);
				}
				else
				{
					$employee = Employees::where('employeeNum', '=', Session::get('editEmployeeID'))->get();
					$status = Session::get('editStatus');

					Session::put('editStatus', false);
				}

				return view('facultyandstaff.admin.edit-employee', compact('employee', 'status', 'facultypositions', 'staffpositions', 'divisions', 'degrees', 'specializations', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processEditEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$enum = Input::get('employeeNum');

				Employees::where('employeeNum', '=', $enum)->update(array("firstName"=>Input::get('firstName'), "middleName"=>Input::get('middleName'), "lastName"=>Input::get('lastName'), "birthdate"=>Input::get('birthdate'), "position"=>Input::get('position'), "division"=>Input::get('division'), "sex"=>Input::get('sex'), "contactNum"=>Input::get('contactNumber'), "emailAddress"=>Input::get('emailAddress'), "currentAddress"=>Input::get('currentAddress'), "permanentAddress"=>Input::get('permanentAddress'), "degree"=>Input::get('degree'), "specialization"=>Input::get('specialization'), "schoolGraduated"=>Input::get('school'), "yearGraduated"=>Input::get('yearGraduated')
					));

				$employee = Employees::where('employeeNum', '=', $enum)->get();

				Session::put('editStatus', true);
				Session::put('editEmployeeID', $enum);

				$logId = 'EDITS'.count(EditStaffLogs::all());	//generates the log id

				EditStaffLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	//adds the log in the database

				$timestamp = date('Y-m-d H:i:s');
				$requestexist = EditNotice::where('employeeNum', '=', $enum)->get();

				if(count($requestexist) > 0)
				{
					EditNotice::where('employeeNum', '=', $enum)->update([
						'employeeNum'=>$employee[0]['employeeNum'],
						'firstName'=>$employee[0]['firstName'], 
						'middleName'=>$employee[0]['middleName'], 
						'lastName'=>$employee[0]['lastName'], 
						'birthdate'=>$employee[0]['birthdate'], 
						'position'=>$employee[0]['position'], 
						'division'=>$employee[0]['division'], 
						'sex'=>$employee[0]['sex'], 
						'contactNum'=>$employee[0]['contactNum'], 
						'emailAddress'=>$employee[0]['emailAddress'],
						'currentAddress'=>$employee[0]['currentAddress'], 
						'permanentAddress'=>$employee[0]['permanentAddress'], 
						'degree'=>$employee[0]['degree'], 
						'specialization'=>$employee[0]['specialization'], 
						'schoolGraduated'=>$employee[0]['schoolGraduated'], 
						'yearGraduated'=>$employee[0]['yearGraduated'],
						'created_at' => $timestamp
					]);
				}
				else
				{
					EditNotice::insert([
						'employeeNum'=>$employee[0]['employeeNum'],
						'firstName'=>$employee[0]['firstName'], 
						'middleName'=>$employee[0]['middleName'], 
						'lastName'=>$employee[0]['lastName'], 
						'birthdate'=>$employee[0]['birthdate'], 
						'position'=>$employee[0]['position'], 
						'division'=>$employee[0]['division'], 
						'sex'=>$employee[0]['sex'], 
						'contactNum'=>$employee[0]['contactNum'], 
						'emailAddress'=>$employee[0]['emailAddress'],
						'currentAddress'=>$employee[0]['currentAddress'], 
						'permanentAddress'=>$employee[0]['permanentAddress'], 
						'degree'=>$employee[0]['degree'], 
						'specialization'=>$employee[0]['specialization'], 
						'schoolGraduated'=>$employee[0]['schoolGraduated'], 
						'yearGraduated'=>$employee[0]['yearGraduated'],
						'created_at' => $timestamp
					]);
				}
				
				return redirect('edit-employee');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function deleteEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				if(Input::has('employeeNum'))
				{
					$enum = Input::get('employeeNum');
				}
				else if(Session::has('employeeNum'))
				{
					$enum = Session::get('employeeNum');
				}
				if(count(Employees::where('employeeNum', '=', $enum)->get()) > 0)
				{
					Employees::where('employeeNum', '=', $enum)->delete();	
				}

				Session::put('deleteStatus', true);

				$logId = 'DELS'.count(DeleteStaffLogs::all());	//generates the log id

				DeleteStaffLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	//adds the log in the database
		
				return redirect('search-employee-filter');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function viewProfile($enum)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				
				$temp = Employees::where('employeeNum', '=', $enum)->get();
				
				if($temp[0]['emailAddress'] == Session::get('email'))
				{
					$id = Session::get('email');
				}
				else
				{
					$id = $temp[0]['emailAddress'];
				}

				$user = DB::table('employees')
					->where('emailAddress', $id)
					->get();

				if(Session::has('status'))
				{
					$status = true;
					$message = "File not found!";
					Session::forget('status');
				}
				else
				{
					$status = false;
					$message = "";
				}

				$fileRecords = UploadedRecords::where('employeeNum', '=', $temp[0]['employeeNum'])->get();

				return view('facultyandstaff.admin.employee-profile', compact('user', 'fileRecords', 'status', 'message', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function getFile($fileName)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$path = storage_path() . '/app/' . $fileName;

			    if(!File::exists($path))
			    {
			    	Session::put('status', false);
			    	return redirect('view-profile');
			    }

			    $file = File::get($path);
			    $type = File::mimeType($path);

			    $response = Response::make($file, 200);
			    $response->header("Content-Type", $type);

			    return $response;
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function generateReport()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				return view('facultyandstaff.admin.generate-report', compact('editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processGenerateReport($num)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$employees = Employees::all();

				if($num == 1)
				{
					$fpdf = new PDF();
					$fpdf->AliasNbPages();
			        $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty and Staff",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
			            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
			            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
			            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
			            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
				        $fpdf->Ln();
				    }

			        $fpdf->Output();
		    	}

		    	else if($num == 2)
		    	{
		    		$fpdf = new PDF();
					$fpdf->AliasNbPages();
			        $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if($e['type'] == 1){
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

			        $fpdf->Output();
		    	}

		    	else if($num == 3)
		    	{
					$fpdf = new PDF();
					$fpdf->AliasNbPages();
			        $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Animal Biology Division",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type']==1) && ($e['division']=="Animal Biology Division"))
				    	{
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
					    }
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Environmental Biology Division",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type']==1) && ($e['division']=="Environmental Biology Division"))
				    	{
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
					    }
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Genetics and Molecular Biology Division",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type']==1) && ($e['division']=="Genetics and Molecular Biology Division")){
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
					    }
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Microbiology Division",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type']==1) && ($e['division']=="Microbiology Division")){
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
					    }
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Plant Biology Division",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);
				    foreach($employees as $e)
				    {
				    	if(($e['type']==1) && ($e['division']=="Plant Biology Division")){
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
					    }
				    }

			        $fpdf->Output();
		    	}

		    	else if($num == 4)
		    	{
		    		$fpdf = new PDF();
					$fpdf->AliasNbPages();
			        $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Instructor",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type'] == 1) && ($e['position']=="Instructor")) {
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Asst. Professor",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type'] == 1) && ($e['position']=="Asst. Professor")) {
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Assoc. Professor",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type'] == 1) && ($e['position']=="Assoc. Professor")) {
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Professor",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type'] == 1) && ($e['position']=="Professor")) {
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

				    $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Faculty - Professor Emeritus",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if(($e['type'] == 1) && ($e['position']=="Professor Emeritus")) {
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

			        $fpdf->Output();
		    	}

		    	else if($num == 5)
		    	{
		    		$fpdf = new PDF();
					$fpdf->AliasNbPages();
			        $fpdf->AddPage();

			        $fpdf->SetY(50);
			        $fpdf->Cell(70);
			        $fpdf->SetFont('Helvetica','B',13);
			        $fpdf->Cell(47,7,"List of All Staff",0,0,'C');

			        $fpdf->SetFont('Arial','B',12);

				    $fpdf->Ln();
				    $fpdf->Cell(47,7,"Name",1,0,'C');
				    $fpdf->Cell(44,7,"Employee No.",1,0,'C');
				    $fpdf->Cell(42,7,"Contact No.",1,0,'C');
				    $fpdf->Cell(52,7,"E-mail Address",1,0,'C');
				    $fpdf->Ln();

				    // Data
				    $fpdf->SetFont('Arial','',11);

				    foreach($employees as $e)
				    {
				    	if($e['type'] == 0){
				            $fpdf->Cell(47,6,"".$e['lastName'].", ".$e['firstName']."",1);
				            $fpdf->Cell(44,6,$e['employeeNum'],1,0,'C');
				            $fpdf->Cell(42,6,$e['contactNum'],1,0,'C');
				            $fpdf->Cell(52,6,$e['emailAddress'],1,0,'C');
					        $fpdf->Ln();
				    	}
				    }

			        $fpdf->Output();
		    	}

		        dd($fpdf->Output());
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function archiveEmployee()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
		        if(Input::has('employeeNum'))
		        {
		        	$eNum = Input::get('employeeNum');
					$employee = Employees::where('employeeNum', '=', $eNum)->get();

					$data = array
					(
						array('Employee Number', 'Type',' First Name', 'Middle Name', 'Last Name', 'Sex', 'Birthdate', 'Position', 'Division', 'Contact Number', 'Email Address', 'Current Address', 'Permanent Address', 'Degree', 'Specialization', 'School Graduated', 'Year Graduated'),

						array($employee[0]->employeeNum, $employee[0]->type, $employee[0]->firstName, $employee[0]->middleName, $employee[0]->lastName, $employee[0]->sex, $employee[0]->birthdate, $employee[0]->position, $employee[0]->division, $employee[0]->contactNum, $employee[0]->emailAddress, $employee[0]->currentAddress, $employee[0]->permanentAddress, $employee[0]->degree, $employee[0]->specialization, $employee[0]->schoolGraduated, $employee[0]->yearGraduated)
					);

					$fileName = "".$employee[0]->employeeNum.".csv";

					$fp = fopen($fileName, 'w');

					foreach ($data as $fields)
					{
					    fputcsv($fp, $fields);
					}

					fclose($fp);

					if(count(ArchivedProfile::where('employeeNum', '=', $employee[0]->employeeNum)->get()) == 0)
					{
						ArchivedProfile::create([
							'employeeNum' => $employee[0]->employeeNum,
							'type' => $employee[0]->type,
							'firstName' => $employee[0]->firstName,
							'lastName' => $employee[0]->lastName
						]);
					}

					Session::put('employeeNum', $eNum);

					if(count(Employees::where('employeeNum', '=', $eNum)->get()) > 0)
					{
						Employees::where('employeeNum', '=', $eNum)->delete();	
					}

					Session::put('archiveStatus', true);
				}

				else
				{
					Session::put('archiveStatus', false);
				}

				//generates the log id
				$logId = 'ARCH'.count(ArchiveLogs::all());	

				//adds the log in the database
				ArchiveLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	
		
		    	return redirect('search-employee-filter');
		    }
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function viewArchive()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$archives = ArchivedProfile::all();

				return view('facultyandstaff.admin.archives', compact('archives', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function retrieveArchive()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$eNum = Input::get('employeeNum');
				$fileName = "".$eNum.".csv";

		        $fp = fopen($fileName, 'r');
		        
		        $i=0;

		        while(! feof($fp))
		        {
		            $information[$i] = fgetcsv($fp);
		            $i++;
		        }

		        $i = 0;

		        foreach ($information as $info) 
		        {
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
			        $i++;
			    }

		        fclose($fp);

		        $rows = 0;

		        for($i=1; $i<count($employeeNum)-1; $i++)
		        {
		            $rows = $rows + AdminController::storeToDb($employeeNum[$i], $type[$i], $firstName[$i], $middleName[$i], $lastName[$i], $sex[$i], $birthdate[$i], $position[$i], $division[$i], $contactNum[$i], $emailAddress[$i], $currentAddress[$i], $permanentAddress[$i], $degree[$i], $specialization[$i], $schoolGraduated[$i], $yearGraduated[$i]);

		            ArchivedProfile::where('employeeNum', '=', $employeeNum[$i])->delete();

		            Session::put('retrieveStatus', true);
		        }

		        return redirect('search-employee-filter');
		    }
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function storeToDb($employeeNum, $type, $firstName, $middleName, $lastName, $sex, $birthdate, $position, $division, $contactNum, $emailAddress, $currentAddress, $permanentAddress, $degree, $specialization, $schoolGraduated, $yearGraduated)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
        		$results = Employees::where('employeeNum', '=', $employeeNum)->get();

		        if(COUNT($results) == 0)
		        {
		            Employees::create(['employeeNum' => $employeeNum, 'type' => $type, 'firstName' => $firstName, 'middleName' => $middleName, 'lastName' => $lastName, 'sex' => $sex, 'birthdate' => $birthdate, 'position' => $position, 'division' => $division ,'contactNum' => $contactNum, 'emailAddress' => $emailAddress, 'currentAddress' => $currentAddress, 'permanentAddress' => $permanentAddress, 'degree' => $degree, 'specialization' => $specialization, 'schoolGraduated' => $schoolGraduated, 'yearGraduated' => $yearGraduated]);

		            return 1;
		        }

		        return 0;
		    }
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');      
    }

    public function uploadRecord()
    {
    	if(Session::has('type'))
    	{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();

		    	if(Input::has('employeeNum'))
		    	{
		    		Session::forget('employeeNum');
		    		Session::put('employeeNum', Input::get('employeeNum'));
		    	}

		    	if(Session::has('message'))
		    	{
		    		$message = Session::get('message');
		    		Session::forget('message');
		    	}
		    	else
		    	{
		    		$message = "";
		    	}

		    	if(Session::has('status'))
		    	{
		    		$status = true;
		    		Session::forget('status');
		    	}
		    	else
		    	{
		    		$status = false;
		    	}

		    	return view('facultyandstaff.admin.upload-record', compact('message', 'status', 'editnotifs'));
		    }
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
    }

    public function processUploadRecord()
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

		        $employeeNum = Session::get('employeeNum');
		        $fileName = "".$employeeNum." - ".$trueFileName."";

		        Storage::disk('local')->put( $fileName, File::get($file));  //store into storage/app

		        Session::put('message', "Successfully uploaded the file!");
		        Session::put('status', true);

		        UploadedRecords::create
		        ([
		        	'employeeNum' => $employeeNum,
		        	'fileName' => $trueFileName,
		        	'fileExtension' => $extension
		        ]);

		        return redirect('upload-record');
		    }
		}

		Session::put('error', 'You must log in first!');
		
		return redirect('login');
    }

    public function viewCourse($key)
    {
    	if(Session::has('type'))
    	{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
		    	$courses = Course::all();
		    	$s = 0;

				if($key == "selected")
				{
					$courseNum = Input::get('courseNum');
					$courseSelected = Course::where('courseNum', '=', $courseNum)->get();
					$s = 1;		
				}

				return view('facultyandstaff.admin.view-course', compact('s', 'courses', 'courseSelected', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
    }

    public function addCourse()
    {
    	if(Session::has('type'))
    	{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
		    	$temp = Session::get('temp');

				if(Session::has('temp'))
				{
					$status = $temp;
					Session::forget('temp');
				}
				else
				{
					$status = 1;
				}

		    	return view('facultyandstaff.admin.add-course', compact('status', 'editnotifs'));
		    }
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
    }

    public function processAddCourse()
    {
    	if(Session::has('type'))
    	{
			if(Session::get('type') == 2)
			{
		    	$courses = Course::all();
		    	$temp = Session::get('temp');

		    	$courseNum = Input::get('courseNum');
		    	$courseTitle = Input::get('courseTitle');
		    	$classification = Input::get('classification');
		    	$numOfUnits = Input::get('numOfUnits');
		    	$prerequisite = Input::get('prerequisite');
		    	$semOffered = "";
		    	$listed = 0;

		    	
		    	if(Input::has('semOffered1'))
		    	{
		    		$semOffered .= "1";
		    		$listed = 1;
		    	}

		    	if(Input::has('semOffered2'))
		    	{
		    		if($listed == 1)
		    			$semOffered .= ",2";
		    		else
		    			$semOffered .= "2";

		    		$listed = 1;
		    	}

		    	if(Input::has('semOfferedS'))
		    	{
		    		if($listed == 1)
		    			$semOffered .= ",S";
		    		else
		    			$semOffered .= "S";
		    	}

		    	//catch case where course number already exists
				if((Course::where('courseNum', '=', $courseNum)->count()) > 0)
				{
					Session::put('temp',0);
					return redirect('add-course');
				}
				
				//adds the course in the database
				Course::create(['courseNum' => $courseNum, 'courseTitle' => $courseTitle, 'classification' => $classification, 'semOffered' => $semOffered, 'prerequisite' => $prerequisite, 'numOfUnits' => $numOfUnits]);

				$temp .= 2;
				Session::put('temp',2);

				$logId = 'ADC'.count(AddCourseLogs::all());	//generates the log id
				//adds the log in the database
				AddCourseLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	
		
				return redirect('add-course');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');	
    } 

    public function editCourse($key)
    {
    	if(Session::has('type'))
    	{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$courses = Course::all();
				$s = 0;
				$status = false;

				if($key == "selected")
				{
					Session::forget('editStatus');
					Session::forget('editCourseNum');

					$courseNum = Input::get('courseNum');
					$courseSelected = Course::where('courseNum', '=', $courseNum)->get();
					$status = false;
					$s = 1;

					Session::put('editStatus', false);
					Session::put('editCourseNum', $courseNum);

					return view('facultyandstaff.admin.edit-course', compact('s', 'courses', 'courseSelected', 'status', 'editnotifs'));		
				}
				else
				{
					$courseSelected = Course::where('courseNum', '=', Session::get('editCourseNum'))->get();
					$status = Session::get('editStatus');

					Session::put('editStatus', false);
				}

				return view('facultyandstaff.admin.edit-course', compact('s', 'courses', 'status', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}


	public function processEditCourse()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$courseNum = Input::get('courseNum');
				Course::where('courseNum', '=', $courseNum)->update(array("courseNum"=>Input::get('courseNum'), "courseTitle"=>Input::get('courseTitle'), "classification"=>Input::get('classification'), "numOfUnits"=>Input::get('numOfUnits'), "prerequisite"=>Input::get('prerequisite'), "semOffered"=>Input::get('semOffered')));

				Session::put('editStatus', true);
				Session::put('editCouseNum', $courseNum);
				$logId = 'EDITC'.count(EditCourseLogs::all());	//generates the log id
				//adds the log in the database
				EditCourseLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	
		
				return redirect('edit-course-select');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function deleteCourse($key)
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$courses = Course::all();
				$status = false;

				$courseNum = Input::get('courseNum');
				Session::put('deleteStatus', false);
				Session::put('deleteCourseNum', $courseNum);

				return view('facultyandstaff.admin.delete-course', compact('courses', 'status', 'editnotifs'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processDeleteCourse()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$courseNum = Input::get('courseNum');
				
				if(count(Course::where('courseNum', '=', $courseNum)->get()) > 0)
				{
					Course::where('courseNum', '=', $courseNum)->delete();	
					Session::put('deleteStatus', true);
					Session::put('deleteCouseNum', $courseNum);
					$status = true;
					$courses = Course::all();		

					$logId = 'DELC'.count(DeleteCourseLogs::all());	//generates the log id
					DeleteCourseLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	//adds the log in the database

					$courses = Course::all();
					$logId = 'DELC'.count(DeleteCourseLogs::all());	//generates the log id
					DeleteCourseLogs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'action'=>'add']);	//adds the log in the database

					return view('facultyandstaff.admin.delete-course', compact('courses', 'status', 'editnotifs'));		
					//return redirect('delete-course-select');
				}
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function viewAllNotifications()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$editnotifs = EditRequest::all();
				$users = Employees::all();

				return view('facultyandstaff.admin.view-notifications', compact('editnotifs', 'users'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processApproveEditRequest()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$enum = Input::get('employeeNum');
				$user = EditRequest::where('employeeNum', '=', $enum)->get();
				$requestMade = $user[0]['created_at']->format('M d Y H:i');
				$requestexist = ApprovedRequest::where('employeeNum', '=', $enum)->get();

				//if($user[0]['updated_at'] != '0000-00-00 00:00:00')
				//	$requestMade = $user[0]['updated_at']->format('d M Y');

				//to code later: get the most recent time when request was made (updated_at)
				//check how to check if updated_at is not set

				$timestamp = date('Y-m-d H:i:s');	

				//update employee info
				Employees::where('employeeNum', '=', $enum)->update([
					'firstName'=>$user[0]['firstName'], 
					'middleName'=>$user[0]['middleName'], 
					'lastName'=>$user[0]['lastName'], 
					'birthdate'=>$user[0]['birthdate'], 
					'position'=>$user[0]['position'], 
					'division'=>$user[0]['division'], 
					'sex'=>$user[0]['sex'], 
					'contactNum'=>$user[0]['contactNum'], 
					'emailAddress'=>$user[0]['emailAddress'],
					'currentAddress'=>$user[0]['currentAddress'], 
					'permanentAddress'=>$user[0]['permanentAddress'], 
					'degree'=>$user[0]['degree'], 
					'specialization'=>$user[0]['specialization'], 
					'schoolGraduated'=>$user[0]['schoolGraduated'], 
					'yearGraduated'=>$user[0]['yearGraduated'],
					'updated_at' => $timestamp
				]);

				//insert to/update approve_requests table 
				ApprovedRequest::insert([
					'employeeNum'=>$user[0]['employeeNum'],
					'firstName'=>$user[0]['firstName'], 
					'middleName'=>$user[0]['middleName'], 
					'lastName'=>$user[0]['lastName'], 
					'birthdate'=>$user[0]['birthdate'], 
					'position'=>$user[0]['position'], 
					'division'=>$user[0]['division'], 
					'sex'=>$user[0]['sex'], 
					'contactNum'=>$user[0]['contactNum'], 
					'emailAddress'=>$user[0]['emailAddress'],
					'currentAddress'=>$user[0]['currentAddress'], 
					'permanentAddress'=>$user[0]['permanentAddress'], 
					'degree'=>$user[0]['degree'], 
					'specialization'=>$user[0]['specialization'], 
					'schoolGraduated'=>$user[0]['schoolGraduated'], 
					'yearGraduated'=>$user[0]['yearGraduated'],
					'requestMadeAt'=>$requestMade,
					'updated_at' => $timestamp
				]);

				EditRequest::where('employeeNum', '=', $enum)->delete();

				$employee = Employees::where('employeeNum', '=', $enum)->get();
				Session::put('editStatus', true);
				Session::put('editEmployeeID', $enum);

				return redirect('notifications');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processDeclineEditRequest()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 2)
			{
				$enum = Input::get('employeeNum');
				$user = EditRequest::where('employeeNum', '=', $enum)->get();
				$requestMade = $user[0]['created_at']->format('M d Y H:i');
				$timestamp = date('Y-m-d H:i:s');

				DeclinedRequest::insert([
					'employeeNum'=>$user[0]['employeeNum'],
					'type'=>$user[0]['type'],
					'firstName'=>$user[0]['firstName'], 
					'middleName'=>$user[0]['middleName'], 
					'lastName'=>$user[0]['lastName'], 
					'birthdate'=>$user[0]['birthdate'], 
					'position'=>$user[0]['position'], 
					'division'=>$user[0]['division'], 
					'sex'=>$user[0]['sex'], 
					'contactNum'=>$user[0]['contactNum'], 
					'emailAddress'=>$user[0]['emailAddress'],
					'currentAddress'=>$user[0]['currentAddress'], 
					'permanentAddress'=>$user[0]['permanentAddress'], 
					'degree'=>$user[0]['degree'], 
					'specialization'=>$user[0]['specialization'], 
					'schoolGraduated'=>$user[0]['schoolGraduated'], 
					'yearGraduated'=>$user[0]['yearGraduated'],
					'requestMadeAt'=>$requestMade,
					'updated_at' => $timestamp
				]);


				EditRequest::where('employeeNum', '=', $enum)->delete();
				Session::put('declineEmployeeID', $enum);

				return redirect('notifications');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

}