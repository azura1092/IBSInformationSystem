<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FacultyPositionTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('faculty_positions')->delete();
		DB::table('faculty_positions')->insert(array(
			['positionTitle' => 'Instructor'],
			['positionTitle' => 'Asst. Professor'],
			['positionTitle' => 'Assoc. Professor'],
			['positionTitle' => 'Professor'],
			['positionTitle' => 'Professor Emeritus']
		));
	}
}