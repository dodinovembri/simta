<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMhsKktFile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mhs_kkt_file', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);			
			$table->string('kp_file', 50);			
			$table->string('krs_file', 50);			
			$table->string('transkrip_file', 50);			
			$table->integer('jumlah_sks_tempuh');			
			$table->integer('jumlah_sks_transkrip');			
			$table->integer('total_sks');			
			$table->text('ket')->nullable();			
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
		Schema::drop('mhs_kkt_file');
	}

}
