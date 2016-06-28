<?php
 
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 
Route::get('', 'HomeController@index');
Route::get('/', 'HomeController@index');

// Authentication Route
	Route::match(['GET', 'POST'], 'attempt_login', 'Auth\AuthController@attempt');

	Route::get('home', 'Auth\AuthController@home');

	Route::get('welcome', function () {
	    return view('home');
	});

	Route::get('auth/google', 'Auth\AuthController@redirectToGoogle');
	Route::get('auth/google/callback', 'Auth\AuthController@handleGoogleCallback');

	Route::get('login', function () {
	    $error = "";
	    if(Session::has('error')){
	    	$error = Session::get('error');
	    	Session::forget('error');
	    }
	    if(!Session::has('type'))
	    	return view('auth.login', compact('error'));
	    else
	    	return redirect('home');
	});

	Route::get('logout', 'Auth\AuthController@logout');
// Administrator Routes
	Route::get('admin-home', 'FacultyAndStaff\AdminController@index');

	//add employee
	Route::get('add-faculty-employee', 'FacultyAndStaff\AdminController@addFacultyEmployee');
	Route::get('add-staff-employee', 'FacultyAndStaff\AdminController@addStaffEmployee');
	Route::post('processAddEmployee', 'FacultyAndStaff\AdminController@processAddFacultyEmployee');
	Route::post('processAddStaffEmployee', 'FacultyAndStaff\AdminController@processAddStaffEmployee');

	//search employee
	Route::match(['GET', 'POST'], 'search-employee-{type}', 'FacultyAndStaff\AdminController@searchEmployee');

	//edit employee
	Route::match(['GET', 'POST'], 'edit-employee', 'FacultyAndStaff\AdminController@editEmployee');
	Route::post('processEditEmployee', 'FacultyAndStaff\AdminController@processEditEmployee');

	//upload bulk data
	Route::get('employee-upload-bulk-data', 'FacultyAndStaff\AdminController@uploadEmployeeBulkData');
	Route::post('process-employee-upload-bulk-data', 'FacultyAndStaff\EmployeeCsvImportController@store');
	//Route::post('process-employee-upload-bulk-data', 'FacultyAndStaff\AdminController@processUploadEmployeeBulkData');

	//delete employee
	Route::post('delete-employee', 'FacultyAndStaff\AdminController@deleteEmployee');

	//archive employee
	Route::post('archive-employee', 'FacultyAndStaff\AdminController@archiveEmployee');

	//upload record
	Route::match(['GET', 'POST'], 'upload-record', 'FacultyAndStaff\AdminController@uploadRecord');
	Route::post('process-upload-record', 'FacultyAndStaff\AdminController@processUploadRecord');
	Route::get('get-file-{fileName}', 'FacultyAndStaff\AdminController@getFile');

	//archives
	Route::get('view-archive', 'FacultyAndStaff\AdminController@viewArchive');
	Route::post('retrieve-archive', 'FacultyAndStaff\AdminController@retrieveArchive');

	//generate report
	Route::get('generate-report', 'FacultyAndStaff\AdminController@generateReport');
	Route::get('generate-{num}', 'FacultyAndStaff\AdminController@processGenerateReport');

	//view view-profile
	Route::match(['GET', 'POST'], 'admin-view-profile-{enum}', 'FacultyAndStaff\AdminController@viewProfile');

	//courses
	Route::get('add-course', 'FacultyAndStaff\AdminController@addCourse');
	Route::post('processAddCourse', 'FacultyAndStaff\AdminController@processAddCourse');

	Route::match(['GET', 'POST'], 'edit-course-{key}', 'FacultyAndStaff\AdminController@editCourse');
	Route::post('processEditCourse', 'FacultyAndStaff\AdminController@processEditCourse');

	Route::get('delete-course-{key}', 'FacultyAndStaff\AdminController@deleteCourse');
	Route::post('processDeleteCourse', 'FacultyAndStaff\AdminController@processDeleteCourse');

	Route::match(['GET', 'POST'], 'view-course-{key}', 'FacultyAndStaff\AdminController@viewCourse');

	//view notifications
	Route::get('notifications', 'FacultyAndStaff\AdminController@viewAllNotifications');

	//approve edit request
	Route::match(['GET', 'POST'], 'processApproveEditRequest', 'FacultyAndStaff\AdminController@processApproveEditRequest');
	
	//decline edit request
	Route::match(['GET', 'POST'], 'processDeclineEditRequest', 'FacultyAndStaff\AdminController@processDeclineEditRequest');

//Alumni
	Route::post('register-user', 'Alumni\GraduateController@processRegister');

	//add graduate
	Route::get('add-graduate', 'Alumni\GraduateController@addGraduate');
	Route::post('processAddGraduate', 'Alumni\GraduateController@processAddGraduate');

	//search graduate
	Route::match(['GET', 'POST'], 'search-graduate-{type}', 'Alumni\GraduateController@searchGraduate');

	//edit graduate
	Route::match(['GET', 'POST'], 'edit-graduate', 'Alumni\GraduateController@editGraduate');
	Route::post('processEditGraduate', 'Alumni\GraduateController@processEditGraduate');

	//delete graduate
	Route::post('delete-graduate', 'Alumni\GraduateController@deleteGraduate');

	//view all records
	Route::get('graph', 'Alumni\GraduateController@visualize');

//Faculty Routes
	Route::get('faculty-home', 'FacultyAndStaff\FacultyController@index');

	//view profile
	Route::get('faculty-profile', 'FacultyAndStaff\FacultyController@viewProfile');

	//request edit profile
	Route::match(['GET', 'POST'], 'edit-faculty-profile', 'FacultyAndStaff\FacultyController@editProfile');
	Route::post('requestEditFacultyProfile', 'FacultyAndStaff\FacultyController@requestEditProfile');

	//view notifications
	Route::get('faculty-notifications', 'FacultyAndStaff\FacultyController@viewAllNotifications');

	//dismiss notification
	Route::match(['GET', 'POST'], 'processDismissFacultyNotif', 'FacultyAndStaff\FacultyController@processDismissFacultyNotif');	

	//view schedule
	Route::match(['GET', 'POST'], 'schedule', 'FacultyAndStaff\FacultyController@viewSchedule');

	//search graduate
	Route::match(['GET', 'POST'], 'staff-search-graduate-{type}', 'FacultyAndStaff\StaffController@searchGraduateStaff');

	//upload record
	Route::match(['GET', 'POST'], 'upload-faculty-record', 'FacultyAndStaff\FacultyController@uploadRecord');
	Route::post('process-upload-faculty-record', 'FacultyAndStaff\FacultyController@processUploadRecord');
	Route::match(['GET', 'POST'], 'view-all-faculty-files', 'FacultyAndStaff\FacultyController@viewAllFiles');
	Route::get('get-faculty-file-{fileName}', 'FacultyAndStaff\FacultyController@getFile');

	//delete file
	Route::match(['GET', 'POST'], 'processDeleteFile', 'FacultyAndStaff\FacultyController@deleteFile');

//Staff Routes
	Route::get('staff-home', 'FacultyAndStaff\StaffController@index');

	//view profile
	Route::get('staff-profile', 'FacultyAndStaff\StaffController@viewProfile');

	//request edit profile
	Route::match(['GET', 'POST'], 'edit-staff-profile', 'FacultyAndStaff\StaffController@editProfile');
	Route::post('requestEditStaffProfile', 'FacultyAndStaff\StaffController@requestEditProfile');


	Route::get('graphStaff', 'FacultyAndStaff\StaffController@visualizeStaff');

	//view notifications
	Route::get('staff-notifications', 'FacultyAndStaff\StaffController@viewAllNotifications');

	//dismiss notification
	Route::match(['GET', 'POST'], 'processDismissStaffNotif', 'FacultyAndStaff\StaffController@processDismissStaffNotif');

	//visualize records
	Route::get('graph', 'Alumni\GraduateController@visualize');

	Route::get('view-user-logs', 'FacultyAndStaff\AdminController@viewSystemLog');

	Route::get('graduate-upload-bulk-data', 'Alumni\GraduateController@uploadGraduateBulkData');
	Route::post('process-graduate-upload-bulk-data', 'Alumni\GraduateCsvImportController@store');
	    
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);
