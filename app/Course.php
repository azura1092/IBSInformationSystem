<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model 
{
	public $timestamps = false;
	protected $fillable = ['courseNum', 'courseTitle', 'classification', 'numOfUnits', 'prerequisite', 'semOffered'];
	protected $table = 'courses';
}
