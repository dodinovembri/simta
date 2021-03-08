<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopikTaHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topik_ta_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);						
			$table->integer('id_topik_ta');
			$table->string('judul_ta', 100)->nullable();
			$table->integer('id_status_agree_topik')->default(1);			
			$table->string('file_konsultasi', 60);			
			$table->text('ket')->nullable();			
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
		Schema::drop('topik_ta_history');
	}

}
