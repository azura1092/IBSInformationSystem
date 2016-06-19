<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovedRequest extends Model {

	protected $fillable = ['employeeNum', 'type', 'firstName', 'middleName', 'lastName', 'sex', 'birthdate', 'position', 'division', 'contactNum', 'emailAddress', 'currentAddress', 'permanentAddress', 'degree', 'specialization', 'schoolGraduated', 'yearGraduated'];
	protected $table = 'approved_requests';
}
