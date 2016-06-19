<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivedProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ArchivedProfile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employeeNum')->unique();
			$table->integer('type');
			$table->string('firstName');
			$table->string('lastName');
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
