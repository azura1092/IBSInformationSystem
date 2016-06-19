<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DivisionTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('divisions')->delete();
		DB::table('divisions')->insert(array(
			['division' => 'Animal Biology Division'],
			['division' => 'Environmental Biology Division'],
			['division' => 'Genetics and Molecular Biology Division'],
			['division' => 'Microbiology Division'],
			['division' => 'Plant Biology Division']

		));
	}
}