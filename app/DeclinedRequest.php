<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclinedRequest extends Model
{
	public $timestamps = false;
	protected $table = 'declined_requests';
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
