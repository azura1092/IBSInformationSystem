<?php namespace App\Http\Controllers\FacultyAndStaff;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Input;
use DB;
use Session;
use Auth;
use File;
use Request;

use App\Employee;
use App\Degree;
use App\Division;
use App\FacultyPosition;
use App\StaffPosition;
use App\Specialization;
use App\EditRequest;
use App\ApprovedRequest;
use App\DeclinedRequest;
use App\EditNotice;
use App\UploadedRecords;

class FacultyController extends Controller {

	public function index(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.faculty.faculty-home', compact('approvedCount', 'declinedCount', 'editNoticeCount'));
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function viewProfile(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get(); 
				$user = Employee::where('employeeNum', '=', $enum)->get();
				$fileRecords = UploadedRecords::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.faculty.faculty-profile', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'user', 'fileRecords'));
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function editProfile(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();


				$facultypositions = FacultyPosition::all();
				$divisions = Division::all();
				$degrees = Degree::all();
				$specializations = Specialization::all();

				if(Input::has('employeeNum')){
					Session::forget('editStatus');
					Session::forget('editEmployeeID');

					$employee = Employee::where('employeeNum', '=', $enum)->get();
					$status = false;
					Session::put('editStatus', false);
					Session::put('editEmployeeID', $enum);
				}
				else{
					$employee = Employee::where('employeeNum', '=', Session::get('editEmployeeID'))->get();
					$status = Session::get('editStatus');

					Session::put('editStatus', false);
				}

				return view('facultyandstaff.faculty.edit-faculty-profile', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'employee', 'status', 'facultypositions', 'divisions', 'degrees', 'specializations'));
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function requestEditProfile(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Input::get('employeeNum');
				$user = Employee::where('employeeNum', '=', $enum)->get();
				$requestexist = EditRequest::where('employeeNum', '=', $enum)->get();

				$timestamp = date('Y-m-d H:i:s');
				
				if(count($requestexist) > 0){
					EditRequest::where('employeeNum', '=', $enum)->update([
						'employeeNum' => Session::get('userEmp')['employeeNum'],
						'type' => Session::get('userEmp')['type'],
						'firstName' => Input::get('firstName'),
						'middleName' => Input::get('middleName'),
						'lastName' => Input::get('lastName'),
						'sex' => Input::get('sex'),
						'birthdate' => Input::get('birthdate'),
						'position' => Input::get('position'),
						'division' => Input::get('division'),
						'contactNum' => Input::get('contactNum'),
						'emailAddress' => Input::get('emailAddress'),
						'currentAddress' => Input::get('currentAddress'),
						'permanentAddress' => Input::get('permanentAddress'),
						'degree' => Input::get('degree'),
						'specialization' => Input::get('specialization'),
						'schoolGraduated' => Input::get('schoolGraduated'),
						'yearGraduated' => Input::get('yearGraduated'),
						'updated_at' => $timestamp
					]);
				}
				else{
					EditRequest::insert([
						'employeeNum' => Session::get('userEmp')['employeeNum'],
						'type' => Session::get('userEmp')['type'],
						'firstName' => Input::get('firstName'),
						'middleName' => Input::get('middleName'),
						'lastName' => Input::get('lastName'),
						'sex' => Input::get('sex'),
						'birthdate' => Input::get('birthdate'),
						'position' => Input::get('position'),
						'division' => Input::get('division'),
						'contactNum' => Input::get('contactNum'),
						'emailAddress' => Input::get('emailAddress'),
						'currentAddress' => Input::get('currentAddress'),
						'permanentAddress' => Input::get('permanentAddress'),
						'degree' => Input::get('degree'),
						'specialization' => Input::get('specialization'),
						'schoolGraduated' => Input::get('schoolGraduated'),
						'yearGraduated' => Input::get('yearGraduated'),
						'created_at' => $timestamp
					]);
				}

				Session::put('editStatus', true);
				Session::put('requestEditEmployeeID', $enum);
				return redirect('edit-faculty-profile');
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function viewAllNotifications(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();

				$approvedusers = ApprovedRequest::where('employeeNum', '=', $enum)->get();
				$declinedusers = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editnoticeusers = EditNotice::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.faculty.view-notifications', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'enum', 'approvedusers', 'declinedusers', 'editnoticeusers'));
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function processDismissFacultyNotif(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$notifType = Input::get('notifType');
				
				if($notifType == "approvedRequest"){
					$empID = Input::get('empID');
					ApprovedRequest::where('id', '=', $empID)->delete();
				}
				
				else if($notifType == "declinedRequest"){
					$empID = Input::get('empID');
					DeclinedRequest::where('id', '=', $empID)->delete();	
				}

				else if($notifType == "editNotice"){
					$empID = Input::get('empID');
					EditNotice::where('id', '=', $empID)->delete();
				}

				return redirect('faculty-notifications');
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function uploadRecord(){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();

		    	if(Input::has('employeeNum')){
		    		Session::forget('employeeNum');
		    		Session::put('employeeNum', Input::get('employeeNum'));
		    	}
		    	if(Session::has('message')){
		    		$message = Session::get('message');
		    		Session::forget('message');
		    	}
		    	else{
		    		$message = "";
		    	}
		    	if(Session::has('status')){
		    		$status = true;
		    		Session::forget('status');
		    	}
		    	else{
		    		$status = false;
		    	}
		    	return view('facultyandstaff.faculty.upload-record', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'message', 'status', 'editnotifs'));
		    }
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function processUploadRecord(){
    	if(Session::has('type')){
			if(Session::get('type') == 1){
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

		        $employeeNum = Session::get('employeeNum');
		        $fileName = "".$employeeNum." - ".$trueFileName."";
		        //$fileName = $file->getFilename().'.'.$trueFileName;         //create string with the name of the file plus its extension
		        Storage::disk('local')->put( $fileName, File::get($file));  //store into storage/app

		        Session::put('message', "Successfully uploaded the file!");
		        Session::put('status', true);

		        UploadedRecords::create([
		        	'employeeNum' => $employeeNum,
		        	'fileName' => $trueFileName,
		        	'fileExtension' => $extension
		        ]);

		        return redirect('upload-faculty-record');
		    }
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
    }

    public function viewAllFiles(){
    	if(Session::has('type')){
			if(Session::get('type') == 1){
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();

				if(Session::has('status')){
					$status = true;
					$message = "File not found!";
					Session::forget('status');
				}
				else{
					$status = false;
					$message = "";
				}

				$fileRecords = UploadedRecords::where('employeeNum', '=', $enum)->get();
				return view('facultyandstaff.faculty.view-files', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'fileRecords'));
		    
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
    }

    public function getFile($fileName){
		if(Session::has('type')){
			if(Session::get('type') == 1){
				$path = storage_path() . '/app/' . $fileName;

			    if(!File::exists($path)){
			    	Session::put('status', false);
			    	return redirect('view-all-faculty-files');
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

	public function deleteFile(){
		if(Session::has('type')){
			if(Session::has('type')){
				$fileName = Input::get('fileName');
				$enum = Session::get('employeeNum');
				$fileID = Input::get('fileID');

				UploadedRecords::where('id', '=', $fileID)->delete();
				return redirect('view-all-faculty-files');
			}
		}
		Session::put('error', 'You must log in first!');
		return redirect('login');
	}

	public function viewSchedule(){
		
	}

}
