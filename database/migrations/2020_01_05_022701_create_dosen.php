<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dosen', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nip', 30);			
			$table->string('nama', 100);			
			$table->text('alamat')->nullable();			
			$table->integer('id_bidang_ilmu');			
			$table->integer('verified_login')->default(0);			
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
		Schema::drop('dosen');
	}

}
