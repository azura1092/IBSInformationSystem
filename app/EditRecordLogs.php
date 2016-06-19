<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EditRecordLogs extends Model {

	//
	protected $fillable = ['logId', 'studnum', 'userNum'];
	protected $table = 'edit_record_logs';
}
