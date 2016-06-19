<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddRecordLogs extends Model {

	//
	protected $fillable = ['logId', 'studnum', 'userNum'];
	protected $table = 'add_record_logs';
}
