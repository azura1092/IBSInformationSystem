<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SpecializationTableSeeder extends Seeder {
	 
	public function run()
	{
		DB::table('specializations')->delete();
		DB::table('specializations')->insert(array(			
			['specialization' => 'Agr. Engineering'],
			['specialization' => 'Biology'],
			['specialization' => 'Botany'],
			['specialization' => 'Botany (Mycology)'],
			['specialization' => 'Cell/Molecular Biology'],
			['specialization' => 'Conservation Biology'],
			['specialization' => 'Crop Physiology'],
			['specialization' => 'Development Zoology'],
			['specialization' => 'Ecology/Environmental Science'],
			['specialization' => 'Entomology'],
			['specialization' => 'Food Science'],
			['specialization' => 'Genetics'],
			['specialization' => 'Horticulture'],
			['specialization' => 'Malacology'],
			['specialization' => 'Marine Ecology/Aquaculture'],
			['specialization' => 'Microbiology'],
			['specialization' => 'Morpho-Anatomy'],
			['specialization' => 'Phycology'],
			['specialization' => 'Plant Breeding'],
			['specialization' => 'Plant Physiology'],
			['specialization' => 'Plant Systematics/Taxonomy'],
			['specialization' => 'Reef Fish Ecology'],
			['specialization' => 'Virology'],
			['specialization' => 'Vertebrate Biology/Vertebrate Pest Management'],
			['specialization' => 'Vertebrate Physiology'],
			['specialization' => 'Wildlife Biology'],
			['specialization' => 'Wildlife Studies'],
			['specialization' => 'Zoology']
		));
	}
}