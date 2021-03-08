<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosenPembimbing extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dosen_pembimbing', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);
			$table->string('nip', 30);
			$table->integer('id_status_penguji')->default(1);			
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
		Schema::drop('dosen_pembimbing');
	}

}
