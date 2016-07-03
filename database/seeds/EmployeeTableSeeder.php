<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Employee;

class EmployeeTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('employees')->delete();			//delete whatever data is present before adding new ones
		DB::table('employees')->insert(array(

			/*['type' => '1',
			'firstName'=>'Ivy Joy',
			'lastName'=>'Aguila',
			'employeeNum'=>'101'],
			
			['type' => '1',
			'firstName'=>'Allister Grant',
			'lastName'=>'Alambra',
			'employeeNum'=>'102'],
			
			['type' => '1',
			'firstName'=>'Eliezer',
			'lastName'=>'Albacea',
			'employeeNum'=>'103'],
			
			['type' => '1',
			'firstName'=>'Zenith',
			'lastName'=>'Arneho',
			'employeeNum'=>'104'],
			
			['type' => '1',
			'firstName'=>'Kristine Elaine',
			'lastName'=>'Bautista',
			'employeeNum'=>'105'],
			
			['type' => '1',
			'firstName'=>'Juan Miguel',
			'lastName'=>'Bawagan III',
			'employeeNum'=>'106'],
			
			['type' => '1',
			'firstName'=>'Sheila Kathleen',
			'lastName'=>'Borja',
			'employeeNum'=>'107'],
			
			['type' => '1',
			'firstName'=>'Rommel',
			'lastName'=>'Bulalacao',
			'employeeNum'=>'108'],
			
			['type' => '1',
			'firstName'=>'Francisco Enrique Vicente',
			'lastName'=>'Castro',
			'employeeNum'=>'109'],
			
			['type' => '1',
			'firstName'=>'Maria Art Antonette',
			'lastName'=>'Clarino',
			'employeeNum'=>'110'],
			
			['type' => '1',
			'firstName'=>'Lailanie',
			'lastName'=>'Danila',
			'employeeNum'=>'111'],
			
			['type' => '1',
			'firstName'=>'Marie Yvette',
			'lastName'=>'De Robles',
			'employeeNum'=>'112'],
			
			['type' => '1',
			'firstName'=>'John Emmanuel',
			'lastName'=>'Encinas',
			'employeeNum'=>'113'],
			
			['type' => '1',
			'firstName'=>'Ailea Kathleen',
			'lastName'=>'Garcera',
			'employeeNum'=>'114'],
			
			['type' => '1',
			'firstName'=>'Joseph Anthony',
			'lastName'=>'Hermocilla',
			'employeeNum'=>'115'],
			
			['type' => '1',
			'firstName'=>'Arian',
			'lastName'=>'Jacildo',
			'employeeNum'=>'116'],
			
			['type' => '1',
			'firstName'=>'Conception',
			'lastName'=>'Khan',
			'employeeNum'=>'117'],
			
			['type' => '1',
			'firstName'=>'Lei Kristoffer',
			'lastName'=>'Lactuan',
			'employeeNum'=>'118'],
			
			['type' => '1',
			'firstName'=>'Fermin Roberto',
			'lastName'=>'Lapitan',
			'employeeNum'=>'119'],
			
			['type' => '1',
			'firstName'=>'Christian John',
			'lastName'=>'Lo',
			'employeeNum'=>'120'],
			
			['type' => '1',
			'firstName'=>'Val Randolf',
			'lastName'=>'Madrid',
			'employeeNum'=>'121'],
			
			['type' => '1',
			'firstName'=>'Katrina Joy',
			'lastName'=>'Magno',
			'employeeNum'=>'122'],
			
			['type' => '1',
			'firstName'=>'Martee Aaron',
			'lastName'=>'Manalang',
			'employeeNum'=>'123'],
			
			['type' => '1',
			'firstName'=>'Vladimir',
			'lastName'=>'Mariano',
			'employeeNum'=>'124'],
			
			['type' => '1',
			'firstName'=>'Danilo',
			'lastName'=>'Mercado',
			'employeeNum'=>'125'],
			
			['type' => '1',
			'firstName'=>'Rizza',
			'lastName'=>'Mercado',
			'employeeNum'=>'126'],
			
			['type' => '1',
			'firstName'=>'Tino-Jan Keith',
			'lastName'=>'Monserrat',
			'employeeNum'=>'127'],
			
			['type' => '1',
			'firstName'=>'Rick Jason',
			'lastName'=>'Obrero',
			'employeeNum'=>'128'],
			
			['type' => '1',
			'firstName'=>'Jaderick',
			'lastName'=>'Pabico',
			'employeeNum'=>'129'],
			
			['type' => '1',
			'firstName'=>'Margarita Carmen',
			'lastName'=>'Paterno',
			'employeeNum'=>'130'],
			
			['type' => '1',
			'firstName'=>'Caroline Natalie',
			'lastName'=>'Peralta',
			'employeeNum'=>'131'],
			
			['type' => '1',
			'firstName'=>'James Carlo',
			'lastName'=>'Plaras',
			'employeeNum'=>'132'],
			
			['type' => '1',
			'firstName'=>'Joe Ramir',
			'lastName'=>'Ramirez',
			'employeeNum'=>'133'],
			
			['type' => '1',
			'firstName'=>'Reginald Neil',
			'lastName'=>'Recario',
			'employeeNum'=>'134'],
			
			['type' => '1',
			'firstName'=>'Mark Harold',
			'lastName'=>'Rivera',
			'employeeNum'=>'135'],
			
			['type' => '1',
			'firstName'=>'Jaime',
			'lastName'=>'Samaniego',
			'employeeNum'=>'136'],
			
			['type' => '1',
			'firstName'=>'Mark Froilan',
			'lastName'=>'Tandoc',
			'employeeNum'=>'137'],
			
			['type' => '1',
			'firstName'=>'Ludwig Johann',
			'lastName'=>'Tirazona',
			'employeeNum'=>'138'],
			
			['type' => '0',
			'firstName'=>'Gianina Renee',
			'lastName'=>'Vergara',
			'employeeNum'=>'139'],
			
			['type' => '0',
			'firstName'=>'Marie Betel',
			'lastName'=>'De Robles',
			'employeeNum'=>'140'],
			
			['type' => '0',
			'firstName'=>'Miyah',
			'lastName'=>'Queliste',
			'employeeNum'=>'141'],*/


			['type' => '2',
			'firstName'=>'Crissa Veah',
			'lastName'=>'Pilien',
			'employeeNum'=>'201211111', 
			'emailAddress'=>'crissaveah23@gmail.com'],

			['type' => '2',
			'firstName'=>'Jun',
			'lastName'=>'Mitra',
			'employeeNum'=>'200914953', 
			'emailAddress'=>'esmitra@up.edu.ph'],

			['type' => '1',
			'firstName'=>'Crissa',
			'lastName'=>'Pilien',
			'employeeNum'=>'201222222',
			'emailAddress' => 'cppilien@up.edu.ph'
			],

			['type' => '1',
			'firstName'=>'KD',
			'lastName'=>'Artificio',
			'employeeNum'=>'201233333',
			'emailAddress' => 'kdianeartificio@gmail.com'
			],

			['type' => '2',
			'firstName'=>'John Paul',
			'lastName'=>'Quijano',
			'employeeNum'=>'233456789', 
			'emailAddress'=>'jtquijano@up.edu.ph']
		));

		/*DB::table('employees')->where('employeeNum', '201211111')
		->update(['registered' => true]);

		DB::table('employees')->where('employeeNum', '201222222')
		->update(['registered' => true]);

		DB::table('employees')->where('employeeNum', '101')
		->update(['registered' => true]);

		DB::table('employees')->where('employeeNum', '140')
		->update(['registered' => true]);*/

	}

}