<?php namespace App\Http\Controllers;

use Session;
use App\Logs;

abstract class MainController extends Controller 
{
	public function log($id, $message)
	{
		$logId = $id.count(Logs::all());
        Logs::create(['logId' => $logId, 'userNum' => Session::get('employeeNum'), 'message' => $message, 'action'=>'add']);
	}
}
