<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengujiT2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penguji_ta_2', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);
			$table->string('nip', 30);
			$table->string('status_penguji', 50)->nullable();
			$table->integer('status_agree_penguji')->default(0);
			$table->text('ket')->nullable();
			$table->dateTime('jadwal')->nullable();
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
		Schema::drop('penguji_ta_2');
	}

}
