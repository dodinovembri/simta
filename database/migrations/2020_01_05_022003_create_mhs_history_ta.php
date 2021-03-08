<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMhsHistoryTa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mhs_history_ta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);
			$table->integer('id_status_ta')->default(1);			
			$table->string('created_by', 50);					
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
		Schema::drop('mhs_history_ta');
	}

}
