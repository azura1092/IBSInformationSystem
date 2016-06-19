<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Session;
use Hybrid_Auth;
use Hybrid_Endpoint;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Employees;
use DB;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

    public function __construct()

    {
    }
   

    public function redirectToGoogle()

    {

        try {
    		return Socialite::driver('google')->redirect();
		}
		catch (GuzzleHttp\Exception\ClientException $e) {
		     dd($e->response);
		}

    }

    public function handleGoogleCallback()
    {
    	$user = Socialite::driver('google')->user();

        Session::put('name', $user->getName());
        Session::put('email', $user->getEmail());
        Session::put('avatar', $user->getAvatar());

        return redirect('attempt_login');

    }

	public function attempt(){
		if(Session::get('name') == null)	//if no input (manually entered /attempt_login) is placed, redirect to index
			return redirect('');

		if(Session::get('email') == null)	
			return redirect('');
		
		$name = Session::get('name');
		$email = Session::get('email');

		$employee = Employees::where('emailAddress', '=', $email)->get();
		$error = "";

		if(count($employee) != 1){
			$error = "".$email." account does not exist.";
			Session::put('error', $error);
			return redirect('/login');
		}

		Session::put('type', $employee[0]['type']);
        Session::put('userEmp', $employee[0]);
		Session::put('employeeNum', $employee[0]['employeeNum']);

		return redirect('home');
	}

	public function home(){
		if(Session::has('type')){
			$type = Session::get('type');
		}
		else{
			return redirect('');
		}

		if($type == '2'){
			return redirect('admin-home');
		}
		else if($type == '1'){
			return redirect('faculty-home');
		}
		else if($type == '0'){
			return redirect('staff-home');
		}
	}

	public function logout(){

		if(Session::has('type')){
			Session::forget('type');
		}
		if(Session::has('name')){
			Session::forget('name');
		}
		if(Session::has('email')){
			Session::forget('email');
		}
		if(Session::has('userEmp')){
			Session::forget('userEmp');
		}
		if(Session::has('avatar')){
			Session::forget('avatar');
		}
		//session_destroy();
		return redirect('https://mail.google.com/mail/u/0/?logout&hl=e');
	}

}
