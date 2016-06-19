<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EditCourseLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'edit_course_logs';
}
