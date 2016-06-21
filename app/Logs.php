<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model 
{
	protected $fillable = ['logId', 'userNum', 'message'];
	protected $table = 'logs';
}
