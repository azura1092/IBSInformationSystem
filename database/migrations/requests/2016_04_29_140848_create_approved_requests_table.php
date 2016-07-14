<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovedRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approved_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeNum');
			$table->integer('type');
			$table->string('firstName');
			$table->string('middleName');
			$table->string('lastName');
			$table->char('sex', 1);
			$table->date('birthdate');
			$table->string('position');
			$table->string('division');
			$table->string('contactNum');
			$table->string('emailAddress');
			$table->string('currentAddress');
			$table->string('permanentAddress');
			$table->string('degree');
			$table->string('specialization');
			$table->string('schoolGraduated');
			$table->string('yearGraduated');
			$table->string('requestMadeAt');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('approved_requests');
	}

}
