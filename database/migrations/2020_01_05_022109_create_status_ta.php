<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status_ta', function(Blueprint $table)
		{
			$table->increments('id');	
			$table->string('status_ta', 50);				
			$table->string('created_by', 50);
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
		Schema::drop('status_ta');
	}

}
