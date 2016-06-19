<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraduateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('graduate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studnum',10)->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('suffix');
            $table->string('mname');
            $table->date('bday');
            $table->string('sex');
            $table->string('degreeprog')->nullable();
            $table->string('major');
            $table->string('mscdegree')->nullable();
            $table->string('yeargrad',4);
            $table->text('honorsreceived')->nullable();
            $table->text('permaddress');
            $table->text('curraddress');
            $table->string('contactnum');
            $table->string('companyname');
            $table->text('companyaddress');
            $table->text('country');
            $table->text('companycontactnum');
            $table->string('companyemail');
            $table->string('position');
            $table->string('natureofwork');
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
