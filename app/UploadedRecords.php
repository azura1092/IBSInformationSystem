<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadedRecords extends Model {

	protected $fillable = ['employeeNum', 'fileName', 'fileExtension'];
	protected $table = 'UploadedRecords';

}
