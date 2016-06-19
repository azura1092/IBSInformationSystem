<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddFacultyLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'add_faculty_logs';
}
