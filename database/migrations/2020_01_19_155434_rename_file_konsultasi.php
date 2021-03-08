<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFileKonsultasi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mhs_perpanjang_sempro', function(Blueprint $table)
		{
			$table->renameColumn('file_konsultasi', 'file_perpanjang');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mhs_perpanjang_sempro', function(Blueprint $table)
		{
			//
		});
	}

}
