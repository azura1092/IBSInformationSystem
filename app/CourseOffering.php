<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOffering extends Model 
{
	public $timestamps = false;
	protected $fillable = ['courseNum', 'section', 'lecture', 'lecturer', 'lab', 'labinstruct'];
	protected $table = 'course_offering';
}