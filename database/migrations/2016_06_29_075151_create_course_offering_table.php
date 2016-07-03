<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseOfferingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_offering', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('courseNum');
			$table->foreign('courseNum')->references('courseNum')->on('courses')->onDelete('cascade');
			$table->string('section',10);
			//$table->integer('units');
			$table->string('lecture',50);
			$table->string('lecturer',50);
			$table->string('lab',50);
			$table->string('labinstruct',50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_offering');
	}

}
