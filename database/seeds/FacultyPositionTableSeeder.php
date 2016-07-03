<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FacultyPositionTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('faculty_positions')->delete();
		DB::table('faculty_positions')->insert(array(
			['positionTitle' => 'Assistant Professor'],
			['positionTitle' => 'Associate Professor'],
			['positionTitle' => 'Instructor'],
			['positionTitle' => 'Professor'],
			['positionTitle' => 'Professor Emeritus']
		));
	}
}