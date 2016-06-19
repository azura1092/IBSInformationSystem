<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteStaffLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'delete_staff_logs';
}
