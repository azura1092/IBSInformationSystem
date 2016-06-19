<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadBulkLogs extends Model {

	//
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'upload_bulk_logs';
}
