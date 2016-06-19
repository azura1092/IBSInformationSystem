<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('DivisionTableSeeder');
		$this->call('DegreeTableSeeder');
		$this->call('FacultyPositionTableSeeder');
		$this->call('StaffPositionTableSeeder');
		$this->call('SpecializationTableSeeder');
		$this->call('CourseTableSeeder');
		$this->call('UsersTableSeeder');
		//$this->call('RoleSeeder');
		$this->call('EmployeeTableSeeder');
	}

}
