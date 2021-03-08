<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurusan extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jurusan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('jurusan', 100);			
			$table->integer('status_aktif')->default(0);			
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
		Schema::drop('jurusan');
	}

}
