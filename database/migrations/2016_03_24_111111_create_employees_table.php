<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeNum')->unique();
			$table->integer('type');
			$table->boolean('registered')->default(false);
			$table->string('firstName');
			$table->string('middleName');
			$table->string('lastName');
			$table->char('sex', 1);
			$table->date('birthdate');
			$table->string('position');
			$table->string('division');
			$table->string('contactNum');
			$table->string('emailAddress')->unique();;
			$table->string('currentAddress');
			$table->string('permanentAddress');
			$table->string('degree');
			$table->string('specialization');
			$table->string('schoolGraduated');
			$table->string('yearGraduated');
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
