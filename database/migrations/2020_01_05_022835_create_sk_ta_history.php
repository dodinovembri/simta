<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkTaHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sk_ta_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);			
			$table->date('tanggal_sk_ta');			
			$table->string('sk_ta_file', 50);			
			$table->integer('id_sk_ta_type');			
			$table->integer('status')->default(0);						
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
		Schema::drop('sk_ta_history');
	}

}
