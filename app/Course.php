<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model 
{
	protected $fillable = ['courseNum', 'courseTitle', 'classification', 'numOfUnits', 'prerequisite', 'semOffered'];
	protected $table = 'courses';
}
