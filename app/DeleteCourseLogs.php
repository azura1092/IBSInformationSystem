<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteCourseLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'delete_course_logs';
}
