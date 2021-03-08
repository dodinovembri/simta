<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMhs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mhs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);			
			$table->string('nama', 100);			
			$table->text('alamat')->nullable();			
			$table->integer('status_kkt_file')->default(0);			
			$table->integer('id_angkatan');			
			$table->integer('id_jurusan');			
			$table->integer('status_aktif')->default(1);			
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
		Schema::drop('mhs');
	}

}
