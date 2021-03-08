<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRole extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_role', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('role', 100);						
			$table->text('desc')->nullable();
			$table->string('created_by');			
			$table->string('updated_by', 50)->nullable();			
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
		Schema::drop('users_role');
	}

}
