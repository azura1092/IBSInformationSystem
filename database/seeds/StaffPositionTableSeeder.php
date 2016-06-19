<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StaffPositionTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('staff_positions')->delete();
		DB::table('staff_positions')->insert(array(
			['positionTitle' => 'University Research Associate'],
			['positionTitle' => 'Admin. Aide'],
			['positionTitle' => 'Lab. Technician'],
			['positionTitle' => 'FSS'],
			['positionTitle' => 'DM III'],
			['positionTitle' => 'LT II'],
			['positionTitle' => 'LA II'],
			['positionTitle' => 'A Aide III'],
			['positionTitle' => 'A Asst V']
		));
	}
}