<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EditStaffLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'edit_staff_logs';
}
