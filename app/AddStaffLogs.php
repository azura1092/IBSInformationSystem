<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddStaffLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'add_staff_logs';
}
