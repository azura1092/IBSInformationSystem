<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovedRequest extends Model 
{
	public $timestamps = false;
	protected $table = 'approved_requests';
	protected $fillable = 
	[
		'employeeNum', 
		'type', 
		'firstName', 
		'middleName', 
		'lastName', 
		'sex', 
		'birthdate', 
		'position', 
		'division', 
		'contactNum', 
		'emailAddress', 
		'currentAddress', 
		'permanentAddress', 
		'degree', 
		'specialization', 
		'schoolGraduated', 
		'yearGraduated'
	];
}
