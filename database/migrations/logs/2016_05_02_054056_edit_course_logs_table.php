<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCourseLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edit_course_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('logId')->unique();
			$table->string('userNum');
			$table->rememberToken();
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
		Schema::table('edit_course_logs', function(Blueprint $table)
		{
			//
		});
	}

}
