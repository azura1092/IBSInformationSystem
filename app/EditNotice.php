<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EditNotice extends Model 
{
	public $timestamps = false;
	protected $table = 'edit_notices';
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
