<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteRecordLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delete_record_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('logId')->unique();
			$table->string('studnum');
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
		Schema::table('delete_record_logs', function(Blueprint $table)
		{
			//
		});
	}

}
