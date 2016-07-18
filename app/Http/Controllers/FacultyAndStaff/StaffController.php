<?php namespace App\Http\Controllers\FacultyAndStaff;

use App\Http\Requests;
use App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use Input;
use DB;
use Session;
use Auth;
use Validator;

use App\Employee;
use App\Graduate;
use App\StaffPosition;
use App\EditRequest;
use App\ApprovedRequest;
use App\EditNotice;
use App\DeclinedRequest;

class StaffController extends MainController 
{
	public function index()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.staff.staff-home', compact('approvedCount', 'declinedCount', 'editNoticeCount'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function viewProfile()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();
				$user = Employee::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.staff.staff-profile', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'user'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');		
	}

	public function editProfile()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();
				$staffpositions = StaffPosition::all();

				if(Input::has('employeeNum'))
				{
					Session::forget('editStatus');
					Session::forget('editEmployeeID');

					$employee = Employee::where('employeeNum', '=', $enum)->get();
					$status = false;
					Session::put('editStatus', false);
					Session::put('editEmployeeID', $enum);
				}
				else
				{
					$employee = Employee::where('employeeNum', '=', Session::get('editEmployeeID'))->get();
					$status = Session::get('editStatus');

					Session::put('editStatus', false);
				}

				parent::log('EDP', 'Edited profile.');

				return view('facultyandstaff.staff.edit-staff-profile', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'employee', 'status', 'staffpositions'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function requestEditProfile()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Input::get('employeeNum');
				$user = Employee::where('employeeNum', '=', $enum)->get();
				$requestexist = EditRequest::where('employeeNum', '=', $enum)->get();

				$inputs = Input::all();
				$rules = array(
					'employeeNum' => 'required|digits:10|unique:employees,employeeNum',
					'firstName' => 'required|min:2',
					'middleName' => 'required|min:2',
					'lastName' => 'required|min:2',
					'sex' => 'required',
					'birthdate' => 'required|date',
					'position' => 'required|exists:staff_positions,positionTitle',
					'contactNum' => 'required',
					'emailAddress' => 'email|required|min:6',
					'currentAddress' => 'required|min:5',
					'permanentAddress' => 'required|min:5'

				);
				// test input against the set rules
				$validation = Validator::make($inputs, $rules);

				if($validation->fails()){
					return redirect('edit-staff-profile')->withInput()->withErrors($validation->errors());
				}

				$timestamp = date('Y-m-d H:i:s');

				if(count($requestexist) > 0)
				{
					EditRequest::where('employeeNum', '=', $enum)->update([
						'employeeNum' => Session::get('userEmp')['employeeNum'],
						'type' => Session::get('userEmp')['type'],
						'firstName' => Input::get('firstName'),
						'middleName' => Input::get('middleName'),
						'lastName' => Input::get('lastName'),
						'sex' => Input::get('sex'),
						'birthdate' => Input::get('birthdate'),
						'position' => Input::get('position'),
						'contactNum' => Input::get('contactNum'),
						'emailAddress' => Input::get('emailAddress'),
						'currentAddress' => Input::get('currentAddress'),
						'permanentAddress' => Input::get('permanentAddress'),
						'updated_at' => $timestamp
					]);
				}
				else
				{
					EditRequest::insert
					([
						'employeeNum' => Session::get('userEmp')['employeeNum'],
						'type' => Session::get('userEmp')['type'],
						'firstName' => Input::get('firstName'),
						'middleName' => Input::get('middleName'),
						'lastName' => Input::get('lastName'),
						'sex' => Input::get('sex'),
						'birthdate' => Input::get('birthdate'),
						'position' => Input::get('position'),
						'contactNum' => Input::get('contactNum'),
						'emailAddress' => Input::get('emailAddress'),
						'currentAddress' => Input::get('currentAddress'),
						'permanentAddress' => Input::get('permanentAddress'),
						'created_at' => $timestamp
					]);
				}
			
				Session::put('editStatus', true);
				Session::put('requestEditEmployeeID', $enum);

				return redirect('edit-staff-profile');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function viewAllNotifications()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get(); 

				$approvedusers = ApprovedRequest::where('employeeNum', '=', $enum)->get();
				$declinedusers = DeclinedRequest::where('employeeNum', '=', $enum)->get();
				$editnoticeusers = EditNotice::where('employeeNum', '=', $enum)->get();

				return view('facultyandstaff.staff.view-notifications', compact('approvedCount', 'declinedCount', 'editNoticeCount', 'enum', 'approvedusers', 'declinedusers', 'editnoticeusers'));
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function processDismissStaffNotif()
	{
		if(Session::has('type'))
		{
			if(Session::get('type') == 0)
			{
				$enum = Session::get('userEmp')['employeeNum'];
				$notifType = Input::get('notifType');
				
				if($notifType == "approvedRequest")
				{
					$empID = Input::get('empID');
					ApprovedRequest::where('id', '=', $empID)->delete();
				}
				
				else if($notifType == "declinedRequest")
				{
					$empID = Input::get('empID');
					DeclinedRequest::where('id', '=', $empID)->delete();	
				}

				else if($notifType == "editNotice")
				{
					$empID = Input::get('empID');
					EditNotice::where('id', '=', $empID)->delete();
				}

				return redirect('staff-notifications');
			}
		}

		Session::put('error', 'You must log in first!');

		return redirect('login');
	}

	public function searchGraduateStaff($type)
	{
		
		if(Session::get('type') == 0)
		{
			$enum = Session::get('userEmp')['employeeNum'];
			$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
			$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
			$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();
		}
		
		if($type == "major")
		{
			$major = Input::get('major');
			$graduates = Graduate::where('major', '=', $major)->paginate(10);
			$status = false;

			return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));		
		}

		else if($type == "mscdegree")
		{
			$mscdegree = Input::get('mscdegree');
			$graduates = Graduate::where('mscdegree', '=', $mscdegree)->paginate(10);
			$status = false;

			return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));		
		}

		else if($type == "yeargrad")
		{
			$yeargrad = Input::get('yeargrad');
			$graduates = Graduate::where('yeargrad', '=', $yeargrad)->paginate(10);
			$status = false;

			return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));		
		}

		else if($type == "companyname")
		{
			$companyname = Input::get('companyname');
			$graduates = Graduate::where('companyname', '=', $companyname)->paginate(10);
			$status = false;

			return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));		
		}

		else if($type == "lname")
		{
			$lname = Input::get('lname');
			$graduates = Graduate::where('lname', '=', $lname)->paginate(10);
			$status = false;

			return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));		
		}

		$graduates = Graduate::orderBy('lname', 'asc')->paginate(10);
		
		return view('facultyandstaff.staff.view-all-staff', compact('graduates', 'approvedCount', 'declinedCount', 'editNoticeCount'));
	}

	public function viewAllStaff()
	{
		$data = DB::table('Graduate')->orderBy('lname', 'asc')->orderBy('mname', 'asc')->orderBy('fname', 'asc')->paginate(10);

		if(Session::has('deleteStatus'))
		{
			$status = true;
			Session::forget('deleteStatus');
		}
		else
		{
			$status = false;
		}

		return view('facultyandstaff.staff.view-all-staff', compact('data', 'status'));
		
	}

	public function visualizeStaff()
	{

		if(Session::get('type') == 0)
		{
				$enum = Session::get('userEmp')['employeeNum'];
				$approvedCount = ApprovedRequest::where('employeeNum', '=', $enum)->get(); 
				$declinedCount = DeclinedRequest::where('employeeNum', '=', $enum)->get(); 
				$editNoticeCount = EditNotice::where('employeeNum', '=', $enum)->get();
		}
		
		$places = DB::table('Graduate')->select(DB::raw('country, count(*) as num'))->groupBy('country')->get();
        $population = DB::table('Graduate')->select(DB::raw('yeargrad, count(*) as num'))->groupBy('yeargrad')->get();
        $majors = DB::table('Graduate')->select(DB::raw('major, count(*) as num'))->groupBy('major')->get();

        return view('facultyandstaff.staff.graphstaff', compact('places', 'population', 'majors','approvedCount', 'declinedCount', 'editNoticeCount'));
	}
}
