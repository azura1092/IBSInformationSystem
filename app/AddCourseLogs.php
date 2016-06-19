<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCourseLogs extends Model 
{
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'add_course_logs';
}
