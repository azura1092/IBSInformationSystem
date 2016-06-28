<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\MainController;
use App\Http\Requests;
use App\Http\Requests\AddGraduateRequest;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Logs;
use App\Graduate;
use App\EditRequest;
use Session;
use Request;
use DB;

class GraduateController extends MainController
{
	public function visualize()
	{
		if(Session::get('type') == 2)
		{
			$editnotifs = EditRequest::all();
		}
		
		$places = DB::table('Graduate')->select(DB::raw('country, count(*) as num'))->groupBy('country')->get();
        $population = DB::table('Graduate')->select(DB::raw('yeargrad, count(*) as num'))->groupBy('yeargrad')->get();
        $majors = DB::table('Graduate')->select(DB::raw('major, count(*) as num'))->groupBy('major')->get();

        return view('graduate.graph', compact('places', 'population', 'majors', 'editnotifs'));
	}

	public function addGraduate()
	{
		$temp = Session::get('temp');

		if(Session::get('type') == 2)
		{
				$editnotifs = EditRequest::all();
		}

		if(Session::has('temp'))
		{
			$status = $temp;
			Session::forget('temp');
			return view('graduate.add', compact('status', 'editnotifs'));
		}
		else
		{
			$status = 1;
			return view('graduate.add', compact('status', 'editnotifs'));
		}

		return view('graduate.add');
	}

	public function processAddGraduate(AddGraduateRequest $request)
	{
		global $temp;
	    $studnum=Input::get('studnum');
	    $fname=Input::get('fname');
	    $lname=Input::get('lname');
	    $suffix=Input::get('suffix');
	    $mname=Input::get('mname');
	    $bday=Input::get('bday');
	    $sex=Input::get('sex');
	    $contactnum=Input::get('contactnum');
	    $permaddress=Input::get('permaddress');
	    $curraddress=Input::get('curraddress');
	    $major=Input::get('major');
	    $mscdegree=Input::get('mscdegree');
	    $yeargrad=Input::get('yeargrad');
	   	$honorsreceived=Input::get('honorsreceived');
	    $companyname=Input::get('companyname');
	    $companyaddress=Input::get('companyaddress');
	    $companyemail=Input::get('companyemail');
	    $companycontactnum=Input::get('companycontactnum');
	    $position=Input::get('position');
	    $natureofwork=Input::get('natureofwork');
	    $country=Input::get('country');
	    
	    
	    $data = array
	    (
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
        );

    	if((Graduate::where('studnum', '=', $studnum)->count()) > 0)
    	{
    		Session::put('temp',0);
			return redirect('add-graduate');
		}
	    

        Graduate::create($data);

        $temp .= 2;
		Session::put('temp',2);

		parent::log('ADD', 'Added an alumnus record.');
	
        return redirect('add-graduate');
	 }

	 public function searchGraduate($type)
	 {
		if(Session::get('type') == 2)
		{
			$editnotifs = EditRequest::all();
		}
		
		if($type == "major")
		{

			$major = Input::get('major');
			$graduates = Graduate::where('major', '=', $major)->paginate(10);
			$status = false;
			return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));		
		}
		else if($type == "mscdegree")
		{
			$mscdegree = Input::get('mscdegree');
			$graduates = Graduate::where('mscdegree', '=', $mscdegree)->paginate(10);
			$status = false;
			return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));		
		}
		else if($type == "yeargrad")
		{
			$yeargrad = Input::get('yeargrad');
			$graduates = Graduate::where('yeargrad', '=', $yeargrad)->paginate(10);
			$status = false;
			return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));		
		} 
		else if($type == "companyname")
		{
			$companyname = Input::get('companyname');
			$graduates = Graduate::where('companyname', '=', $companyname)->paginate(10);
			$status = false;
			return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));		
		}
		else if($type == "lname")
		{
			$lname = Input::get('lname');
			$graduates = Graduate::where('lname', '=', $lname)->paginate(10);
			$status = false;
			return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));
		}

		$graduates = Graduate::orderBy('lname', 'asc')->paginate(10);

		if(Session::has('deleteStatus'))
		{
			$status = true;
			Session::forget('deleteStatus');
		}
		else
		{
			$status = false;
		}

		parent::log('SRCH', 'Searched for an alumnus.');

		return view('graduate.view-all', compact('graduates', 'status', 'editnotifs'));
	}

	public function viewAll()
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

		return view('graduate.view-all', compact('data', 'status'));
	}

	public function editGraduate()
	{
		if(Session::get('type') == 2)
		{
			$editnotifs = EditRequest::all();
		}

		if(Input::has('studnum'))
		{
			Session::forget('editStatus');
			Session::forget('editstudnum');

			$studnum = Input::get('studnum');
			$graduate = Graduate::where('studnum', '=', $studnum)->get();
			$status = false;
			Session::put('editStatus', false);
			Session::put('editstudnum', $studnum);

			return view('graduate.edit-graduate', compact('graduate', 'status', 'editnotifs'));
		}
		else
		{
			$graduate = Graduate::where('studnum', '=', Session::get('editstudnum'))->get();
			$status = Session::get('editStatus');

			Session::put('editStatus', false);

			return view('graduate.edit-graduate', compact('graduate', 'status', 'editnotifs'));
		}
	}

	public function processEditGraduate()
	{
		$studnum = Input::get('studnum');

		Graduate::where('studnum', '=', $studnum)->update(array("fname"=>Input::get('fname'), "mname"=>Input::get('mname'), "lname"=>Input::get('lname'),'suffix'=>Input::get('suffix'),'bday'=>Input::get('bday'), 'sex'=>Input::get('sex'), 'contactnum'=>Input::get('contactnum'), 'permaddress'=>Input::get('permaddress'), 'curraddress'=>Input::get('curraddress'), 'major'=>Input::get('major'), 'mscdegree'=>Input::get('mscdegree'), 'yeargrad'=>Input::get('yeargrad'), 'honorsreceived'=>Input::get('honorsreceived'), 'companyname'=>Input::get('companyname'), 'position'=>Input::get('position'), 'natureofwork'=>Input::get('natureofwork'),'companyaddress'=>Input::get('companyaddress'), 'country'=>Input::get('country'), 'companyemail'=>Input::get('companyemail'), 'companycontactnum'=>Input::get('companycontactnum'))); 
		$graduate = Graduate::where('studnum', '=', $studnum)->get();

		Session::put('editStatus', true);
		Session::put('editstudnum', $studnum);

		parent::log('EDIT', 'Edited graduate record.');

		return redirect('edit-graduate');
	}

	public function deleteGraduate()
	{
		$studnum = Input::get('studnum');

		if(count(Graduate::where('studnum', '=', $studnum)->get()) > 0)
			Graduate::where('studnum', '=', $studnum)->delete();	

		Session::put('deleteStatus', true);

		parent::log('DEL', 'Deleted graduate record.');
		
		return redirect('search-graduate-filter');
	}

	public function uploadGraduateBulkData()
	{
		$message = "";
		$status = -1;

		if(Session::get('type') == 2)
		{
			$editnotifs = EditRequest::all();
		}

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
		
		return view('graduate.upload-bulk-data', compact('message', 'status', 'editnotifs'));
	}
}