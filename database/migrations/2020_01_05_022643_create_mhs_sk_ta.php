<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMhsSkTa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mhs_sk_ta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);			
			$table->date('tanggal_sk_ta');			
			$table->string('sk_ta_file', 50);			
			$table->integer('id_sk_ta_type')->default(1);			
			$table->integer('status')->default(1);						
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
		Schema::drop('mhs_sk_ta');
	}

}
