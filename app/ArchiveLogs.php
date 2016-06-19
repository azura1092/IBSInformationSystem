<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveLogs extends Model 
{
	protected $fillable = ['logId', 'userNum'];
	protected $table = 'archive_logs';
}
