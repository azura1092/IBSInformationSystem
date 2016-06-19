<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DegreeTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('degrees')->delete();
		DB::table('degrees')->insert(array(
			['degree' => 'B.S.'],
			['degree' => 'M.S.'],
			['degree' => 'Ph.D.'],
			['degree' => 'Dr.ret.nat']
		));
	}
}