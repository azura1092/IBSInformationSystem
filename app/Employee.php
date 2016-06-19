<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	protected $fillable = ['employeeNum', 'type', 'firstName', 'middleName', 'lastName', 'sex', 'birthdate', 'position', 'division', 'contactNum', 'emailAddress', 'currentAddress', 'permanentAddress', 'degree', 'specialization', 'schoolGraduated', 'yearGraduated', 'username'];
	protected $table = 'employees';
}
