<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteRecordLogs extends Model {

	//
	protected $fillable = ['logId', 'studnum', 'userNum'];
	protected $table = 'delete_record_logs';
}
