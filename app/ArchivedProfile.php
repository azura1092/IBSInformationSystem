<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivedProfile extends Model {

	protected $fillable = ['employeeNum', 'type', 'firstName', 'lastName'];
	protected $table = 'ArchivedProfile';

}
