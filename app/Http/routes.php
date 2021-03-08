<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/', 'Auth\AuthController@getLogin');

// route for admin
Route::group(['prefix' => 'admin'], function()
{
	Route::get('/', ['middleware' => ['roles'], 'uses' => 'Admin@index', 'roles' => ['admin']]);

	Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin@index',  'middleware' => ['roles'], 'roles' => ['admin']]);	
	Route::get('/profile', ['as' => 'admin.profile', 'middleware' => ['roles'], 'uses' => 'Admin@profile', 'roles' => ['admin']]);    	
	Route::get('/edit_pass', ['as' => 'admin.edit_pass', 'middleware' => ['roles'], 'uses' => 'Admin@edit_pass', 'roles' => ['admin']]);    
	Route::post('/store_update_pass/{id}', ['as' => 'admin.store_update_pass', 'middleware' => ['roles'], 'uses' => 'Admin@store_update_pass', 'roles' => ['admin']]);	
	Route::post('/edit_profile/{id}', ['as' => 'admin.edit_profile', 'middleware' => ['roles'], 'uses' => 'Admin@edit_profile', 'roles' => ['admin']]);
	Route::group(['prefix' => 'master'], function()
	{
		Route::get('/mhs', ['as' => 'admin.master.mhs', 'uses' => 'Admin@mhs', 'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/syarat_ta_1', ['as' => 'admin.master.syarat_ta_1', 'uses' => 'Admin@syarat_ta_1', 'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/syarat_ta_2', ['as' => 'admin.master.syarat_ta_2', 'uses' => 'Admin@syarat_ta_2', 'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/export-template-mhs', ['as' => 'admin.master.mhs.export', 'uses' => 'Admin@downloadTemplate', 'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/import-mhs', ['as' => 'admin.master.mhs.import', 'uses' => 'Admin@ImportMhs', 'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/dosen', ['as' => 'admin.master.dosen', 'uses' => 'Admin@dosen', 'middleware' => ['roles'], 'roles' => ['admin']]);
	});

	Route::group(['prefix' => 'transactions'], function()
	{
		Route::get('/mhs_aktif', ['as' => 'admin.transactions.mhs_aktif', 'uses' => 'Admin@mhs_aktif',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/mhs_memenuhi_syarat', ['as' => 'admin.transactions.mhs_memenuhi_syarat', 'uses' => 'Admin@mhs_memenuhi_syarat',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/mhs_tidak_memenuhi_syarat', ['as' => 'admin.transactions.mhs_tidak_memenuhi_syarat', 'uses' => 'Admin@mhs_tidak_memenuhi_syarat',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/verifikasi_data_mhs', ['as' => 'admin.transactions.verifikasi_data_mhs', 'uses' => 'Admin@verifikasi_data_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/topik_ta_mhs', ['as' => 'admin.transactions.topik_ta_mhs', 'uses' => 'Admin@topik_ta_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);

		Route::get('/verifikasi_data_mhs_detail/{id}', ['as' => 'admin.transactions.verifikasi_data_mhs_detail', 'uses' => 'Admin@verifikasi_data_mhs_detail',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/verifikasi_data_mhs_detail/{id}', ['as' => 'admin.transactions.store_verifikasi_data_mhs_detail', 'uses' => 'Admin@store_verifikasi_data_mhs_detail',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/upload_data_mhs', ['as' => 'admin.transactions.upload_data_mhs', 'uses' => 'Admin@upload_data_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/verifikasi_sukses', ['as' => 'admin.transactions.verifikasi_sukses', 'uses' => 'Admin@verifikasi_sukses',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/verifikasi_gagal', ['as' => 'admin.transactions.verifikasi_gagal', 'uses' => 'Admin@verifikasi_gagal',  'middleware' => ['roles'], 'roles' => ['admin']]);
		//sempro
		Route::get('/jadwal_sempro', ['as' => 'admin.transactions.jadwal_sempro', 'uses' => 'Admin@jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/jadwal_sempro_mhs/{id}', ['as' => 'admin.transactions.jadwal_sempro_mhs', 'uses' => 'Admin@jadwal_sempro_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_jadwal_sempro', ['as' => 'admin.transactions.store_jadwal_sempro', 'uses' => 'Admin@store_jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/status_sempro', ['as' => 'admin.transactions.status_sempro', 'uses' => 'Admin@status_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/update_status_sempro/{id}', ['as' => 'admin.transactions.update_status_sempro', 'uses' => 'Admin@update_status_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);

		// kompre
		Route::get('/jadwal_kompre', ['as' => 'admin.transactions.jadwal_kompre', 'uses' => 'Admin@jadwal_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/status_kompre', ['as' => 'admin.transactions.status_kompre', 'uses' => 'Admin@status_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/jadwal_kompre_mhs/{id}', ['as' => 'admin.transactions.jadwal_kompre_mhs', 'uses' => 'Admin@jadwal_kompre_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_jadwal_kompre', ['as' => 'admin.transactions.store_jadwal_kompre', 'uses' => 'Admin@store_jadwal_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);



		Route::get('/add_new_dosen', ['as' => 'admin.transactions.add_new_dosen', 'uses' => 'Admin@add_new_dosen',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_new_dosen', ['as' => 'admin.transactions.store_new_dosen', 'uses' => 'Admin@store_new_dosen',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/delete_dosen/{id}', ['as' => 'admin.transactions.delete_dosen', 'uses' => 'Admin@delete_dosen',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/edit_dosen/{id}', ['as' => 'admin.transactions.edit_dosen', 'uses' => 'Admin@edit_dosen',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_edit_new_dosen/{id}', ['as' => 'admin.transactions.store_edit_new_dosen', 'uses' => 'Admin@store_edit_new_dosen',  'middleware' => ['roles'], 'roles' => ['admin']]);

		Route::get('/add_new_mhs', ['as' => 'admin.transactions.add_new_mhs', 'uses' => 'Admin@add_new_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_new_mhs', ['as' => 'admin.transactions.store_new_mhs', 'uses' => 'Admin@store_new_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/edit_mhs/{id}', ['as' => 'admin.transactions.edit_mhs', 'uses' => 'Admin@edit_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_edit_new_mhs/{id}', ['as' => 'admin.transactions.store_edit_new_mhs', 'uses' => 'Admin@store_edit_new_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/delete_mhs/{id}', ['as' => 'admin.transactions.delete_mhs', 'uses' => 'Admin@delete_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);

		Route::get('/add_new_syarat_sempro', ['as' => 'admin.transactions.add_new_syarat_sempro', 'uses' => 'Admin@add_new_syarat_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_new_syarat_sempro', ['as' => 'admin.transactions.store_new_syarat_sempro', 'uses' => 'Admin@store_new_syarat_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/edit_syarat_ta_1/{id}', ['as' => 'admin.transactions.edit_syarat_ta_1', 'uses' => 'Admin@edit_syarat_ta_1',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_edit_syarat_sempro/{id}', ['as' => 'admin.transactions.store_edit_syarat_sempro', 'uses' => 'Admin@store_edit_syarat_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/delete_syarat_ta_1/{id}', ['as' => 'admin.transactions.delete_syarat_ta_1', 'uses' => 'Admin@delete_syarat_ta_1',  'middleware' => ['roles'], 'roles' => ['admin']]);

		Route::get('/add_new_syarat_kompre', ['as' => 'admin.transactions.add_new_syarat_kompre', 'uses' => 'Admin@add_new_syarat_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_new_syarat_kompre', ['as' => 'admin.transactions.store_new_syarat_kompre', 'uses' => 'Admin@store_new_syarat_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/edit_syarat_ta_2/{id}', ['as' => 'admin.transactions.edit_syarat_ta_2', 'uses' => 'Admin@edit_syarat_ta_2',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_edit_syarat_kompre/{id}', ['as' => 'admin.transactions.store_edit_syarat_kompre', 'uses' => 'Admin@store_edit_syarat_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/delete_syarat_ta_2/{id}', ['as' => 'admin.transactions.delete_syarat_ta_2', 'uses' => 'Admin@delete_syarat_ta_2',  'middleware' => ['roles'], 'roles' => ['admin']]);

		Route::get('/verifikasi_seminar', ['as' => 'admin.transactions.verifikasi_seminar', 'uses' => 'Admin@verifikasi_seminar',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/verifikasi_seminar_detail/{nim}', ['as' => 'admin.transactions.verifikasi_seminar_detail', 'uses' => 'Admin@verifikasi_seminar_detail',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_syarat_ta_1_mhs', ['as' => 'admin.transactions.store_syarat_ta_1_mhs', 'uses' => 'Admin@store_syarat_ta_1_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/store_konfirmasi_sudah_sempro/{id}', ['as' => 'dosen.transactions.store_konfirmasi_sudah_sempro', 'uses' => 'Admin@store_konfirmasi_sudah_sempro',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/store_konfirmasi_sudah_kompre/{id}', ['as' => 'dosen.transactions.store_konfirmasi_sudah_kompre', 'uses' => 'Admin@store_konfirmasi_sudah_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::get('/verifikasi_kompre', ['as' => 'admin.transactions.verifikasi_kompre', 'uses' => 'Admin@verifikasi_kompre',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/verifikasi_kompre_detail/{nim}', ['as' => 'admin.transactions.verifikasi_kompre_detail', 'uses' => 'Admin@verifikasi_kompre_detail',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/store_syarat_ta_2_mhs', ['as' => 'admin.transactions.store_syarat_ta_2_mhs', 'uses' => 'Admin@store_syarat_ta_2_mhs',  'middleware' => ['roles'], 'roles' => ['admin']]);		

	});

	Route::group(['prefix' => 'system'], function()
	{
		// Topik TA
		Route::get('/topik_ta', ['as' => 'admin.system.topik_ta', 'uses' => 'System@topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/add_new_topik_ta', ['as' => 'admin.system.add_new_topik_ta', 'uses' => 'System@add_new_topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::post('/store_new_topik_ta', ['as' => 'admin.system.store_new_topik_ta', 'uses' => 'System@store_new_topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/topik_ta/delete/{id}', ['as' => 'admin.system.topik_ta.delete', 'uses' => 'System@delete_topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/topik_ta/edit/{id}', ['as' => 'admin.system.topik_ta.edit', 'uses' => 'System@edit_topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/topik_ta/store_edit', ['as' => 'admin.system.topik_ta.store_edit', 'uses' => 'System@store_edit_topik_ta',  'middleware' => ['roles'], 'roles' => ['admin']]);		

		// routes for angkatan
		Route::get('/angkatan', ['as' => 'admin.system.angkatan', 'uses' => 'System@angkatan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/add_new_angkatan', ['as' => 'admin.system.add_new_angkatan', 'uses' => 'System@add_new_angkatan',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::post('/store_new_angkatan', ['as' => 'admin.system.store_new_angkatan', 'uses' => 'System@store_new_angkatan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/angkatan/delete/{id}', ['as' => 'admin.system.angkatan.delete', 'uses' => 'System@delete_angkatan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/angkatan/edit/{id}', ['as' => 'admin.system.angkatan.edit', 'uses' => 'System@edit_angkatan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/angkatan/store_edit', ['as' => 'admin.system.angkatan.store_edit', 'uses' => 'System@store_edit',  'middleware' => ['roles'], 'roles' => ['admin']]);

		// routes for bidang ilmu
		Route::get('/bidang_ilmu', ['as' => 'admin.system.bidang_ilmu', 'uses' => 'System@bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/add_new_bidang_ilmu', ['as' => 'admin.system.add_new_bidang_ilmu', 'uses' => 'System@add_new_bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::post('/store_new_bidang_ilmu', ['as' => 'admin.system.store_new_bidang_ilmu', 'uses' => 'System@store_new_bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/bidang_ilmu/delete/{id}', ['as' => 'admin.system.bidang_ilmu.delete', 'uses' => 'System@delete_bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/bidang_ilmu/edit/{id}', ['as' => 'admin.system.bidang_ilmu.edit', 'uses' => 'System@edit_bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/bidang_ilmu/store_edit', ['as' => 'admin.system.bidang_ilmu.store_edit', 'uses' => 'System@store_edit_bidang_ilmu',  'middleware' => ['roles'], 'roles' => ['admin']]);

		// routes for user account list
		Route::get('/user_account_list', ['as' => 'admin.system.user_account_list', 'uses' => 'System@user_account_list',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/add_new_user', ['as' => 'admin.system.add_new_user', 'uses' => 'System@add_new_user',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::post('/store_new_user', ['as' => 'admin.system.store_new_user', 'uses' => 'System@store_new_user',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/user/delete/{id}', ['as' => 'admin.system.user.delete', 'uses' => 'System@delete_user',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/user/edit/{id}', ['as' => 'admin.system.user.edit', 'uses' => 'System@edit_user',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/user/store_edit', ['as' => 'admin.system.user.store_edit', 'uses' => 'System@store_edit_user',  'middleware' => ['roles'], 'roles' => ['admin']]);	

		Route::get('/user/add_new_mhs_to_user', ['as' => 'admin.system.add_new_mhs_to_user', 'uses' => 'System@add_new_mhs_to_user',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::get('/user/store_new_mhs_to_user/{id}', ['as' => 'admin.system.store_new_mhs_to_user', 'uses' => 'System@store_new_mhs_to_user',  'middleware' => ['roles'], 'roles' => ['admin']]);


		Route::get('/user/add_new_dosen_to_user', ['as' => 'admin.system.add_new_dosen_to_user', 'uses' => 'System@add_new_dosen_to_user',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::get('/user/store_new_dosen_to_user/{id}', ['as' => 'admin.system.store_new_dosen_to_user', 'uses' => 'System@store_new_dosen_to_user',  'middleware' => ['roles'], 'roles' => ['admin']]);		

		// routes for jurusan
		Route::get('/jurusan', ['as' => 'admin.system.jurusan', 'uses' => 'System@jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/add_new_jurusan', ['as' => 'admin.system.add_new_jurusan', 'uses' => 'System@add_new_jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);	
		Route::post('/store_new_jurusan', ['as' => 'admin.system.store_new_jurusan', 'uses' => 'System@store_new_jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/jurusan/delete/{id}', ['as' => 'admin.system.jurusan.delete', 'uses' => 'System@delete_jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::get('/jurusan/edit/{id}', ['as' => 'admin.system.jurusan.edit', 'uses' => 'System@edit_jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);
		Route::post('/jurusan/store_edit', ['as' => 'admin.system.jurusan.store_edit', 'uses' => 'System@store_edit_jurusan',  'middleware' => ['roles'], 'roles' => ['admin']]);		
	});	
});

// route for pengelola
Route::group(['prefix' => 'pengelola'], function()
{
	Route::get('/', ['middleware' => ['roles'], 'uses' => 'Pengelola@index', 'roles' => ['admin', 'pengelola']]);

	Route::get('/dashboard', ['as' => 'pengelola.dashboard', 'uses' => 'Pengelola@index',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
	Route::get('/profile', ['as' => 'pengelola.profile', 'middleware' => ['roles'], 'uses' => 'Pengelola@profile', 'roles' => ['pengelola']]);  
	Route::get('/edit_pass', ['as' => 'pengelola.edit_pass', 'middleware' => ['roles'], 'uses' => 'Pengelola@edit_pass', 'roles' => ['pengelola']]);    
	Route::post('/store_update_pass/{nip}', ['as' => 'pengelola.store_update_pass', 'middleware' => ['roles'], 'uses' => 'Pengelola@store_update_pass', 'roles' => ['pengelola']]);	  	
	Route::post('/edit_profile/{id}', ['as' => 'pengelola.edit_profile', 'middleware' => ['roles'], 'uses' => 'Pengelola@edit_profile', 'roles' => ['pengelola']]);	

	Route::group(['prefix' => 'transactions'], function()
	{
		Route::get('/mhs', ['as' => 'pengelola.transactions.mhs', 'uses' => 'Pengelola@mhs',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/dosen', ['as' => 'pengelola.transactions.dosen', 'uses' => 'Pengelola@dosen',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/mhs_memenuhi_syarat', ['as' => 'pengelola.transactions.mhs_memenuhi_syarat', 'uses' => 'Pengelola@mhs_memenuhi_syarat',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/mhs_tidak_memenuhi_syarat', ['as' => 'pengelola.transactions.mhs_tidak_memenuhi_syarat', 'uses' => 'Pengelola@mhs_tidak_memenuhi_syarat',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/verifikasi_sukses', ['as' => 'pengelola.transactions.verifikasi_sukses', 'uses' => 'Pengelola@verifikasi_sukses',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/verifikasi_gagal', ['as' => 'pengelola.transactions.verifikasi_gagal', 'uses' => 'Pengelola@verifikasi_gagal',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/set_pembimbing_skripsi', ['as' => 'pengelola.transactions.set_pembimbing_skripsi', 'uses' => 'Pengelola@set_pembimbing_skripsi',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/penguji_sempro', ['as' => 'pengelola.transactions.penguji_sempro', 'uses' => 'Pengelola@penguji_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/penguji_sempro_mhs/{id}', ['as' => 'pengelola.transactions.penguji_sempro_mhs', 'uses' => 'Pengelola@penguji_sempro_mhs',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::post('/store_mhs_penguji_sempro_mhs', ['as' => 'mhs.transactions.store_mhs_penguji_sempro_mhs', 'uses' => 'Pengelola@store_mhs_penguji_sempro_mhs',  'middleware' => ['roles'], 'roles' => ['pengelola']]);


		Route::get('/konfirmasi_perpanjang_sempro_dosen', ['as' => 'pengelola.transactions.konfirmasi_perpanjang_sempro_dosen', 'uses' => 'Pengelola@konfirmasi_perpanjang_sempro_dosen',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/konfirmasi_perpanjang_kompre_dosen', ['as' => 'pengelola.transactions.konfirmasi_perpanjang_kompre_dosen', 'uses' => 'Pengelola@konfirmasi_perpanjang_kompre_dosen',  'middleware' => ['roles'], 'roles' => ['pengelola']]);

		Route::get('/status_sempro', ['as' => 'pengelola.transactions.status_sempro', 'uses' => 'Pengelola@status_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/status_kompre', ['as' => 'pengelola.transactions.status_kompre', 'uses' => 'Pengelola@status_kompre',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/menyetujui_topik_ta', ['as' => 'pengelola.transactions.menyetujui_topik_ta', 'uses' => 'Pengelola@menyetujui_topik_ta',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::post('/menyetujui_topik_ta/update/{id}', ['as' => 'pengelola.transactions.menyetujui_topik_ta.update', 'uses' => 'Pengelola@menyetujui_topik_ta_update',  'middleware' => ['roles'], 'roles' => ['pengelola']]);


		// TA
		Route::get('/set_pembimbing_skripsi', ['as' => 'pengelola.transactions.set_pembimbing_skripsi', 'uses' => 'Pengelola@set_pembimbing_skripsi',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/status_skripsi', ['as' => 'pengelola.transactions.status_skripsi', 'uses' => 'Ta_2@status_skripsi',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/penguji_skripsi', ['as' => 'pengelola.transactions.penguji_skripsi', 'uses' => 'Pengelola@penguji_skripsi',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/status_kompre/{id}', ['as' => 'pengelola.transactions.detail_kompre', 'uses' => 'Pengelola@detail_kompre',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/konfirmasi_penguji_kompre', ['as' => 'pengelola.transactions.konfirmasi_penguji_kompre', 'uses' => 'Pengelola@konfirmasi_penguji_kompre',  'middleware' => ['roles'], 'roles' => ['pengelola']]);

		// SEMPRO
		Route::get('/set_pembimbing_sempro', ['as' => 'pengelola.transactions.set_pembimbing_sempro', 'uses' => 'Pengelola@set_pembimbing_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/perpanjang_sempro', ['as' => 'pengelola.transactions.perpanjang_sempro', 'uses' => 'Pengelola@perpanjang_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::post('/penguji_sempro', ['as' => 'pengelola.transactions.store_penguji_sempro', 'uses' => 'Pengelola@store_penguji_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/jadwal_sempro', ['as' => 'pengelola.transactions.jadwal_sempro', 'uses' => 'Pengelola@jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);

		Route::get('/konfirmasi_penguji_sempro', ['as' => 'pengelola.transactions.konfirmasi_penguji_sempro', 'uses' => 'Pengelola@konfirmasi_penguji_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);

		Route::get('/status_sempro/{id}', ['as' => 'pengelola.transactions.detail_sempro', 'uses' => 'Pengelola@detail_sempro',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/konfirmasi_penguji_skripsi', ['as' => 'pengelola.transactions.konfirmasi_penguji_skripsi', 'uses' => 'Pengelola@konfirmasi_penguji_skripsi',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/setuju_topik_ta/{nim}', ['as' => 'pengelola.transactions.setuju_topik_ta', 'uses' => 'Pengelola@setuju_topik_ta',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::post('/store_setuju_topik_ta_by_pengelola', ['as' => 'pengelola.transactions.store_setuju_topik_ta_by_pengelola', 'uses' => 'Pengelola@store_setuju_topik_ta_by_pengelola',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::get('/ubah_penguji_mhs/{id}', ['as' => 'pengelola.transactions.ubah_penguji_mhs', 'uses' => 'Pengelola@ubah_penguji_mhs',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
		Route::post('/store_ubah_penguji/{id}', ['as' => 'pengelola.transactions.store_ubah_penguji', 'uses' => 'Pengelola@store_ubah_penguji',  'middleware' => ['roles'], 'roles' => ['pengelola']]);
	
	});

});

// route for dosen
Route::group(['prefix' => 'dosen'], function()
{
	Route::get('/', ['middleware' => ['roles'], 'uses' => 'Dosen@index', 'roles' => ['dosen', 'admin']]);

	Route::get('/dashboard', ['as' => 'dosen.dashboard', 'uses' => 'Dosen@index',  'middleware' => ['roles'], 'roles' => ['dosen']]);
	
	Route::get('/profile', ['as' => 'dosen.profile', 'middleware' => ['roles'], 'uses' => 'Dosen@profile', 'roles' => ['dosen']]);    
	Route::get('/edit_pass', ['as' => 'dosen.edit_pass', 'middleware' => ['roles'], 'uses' => 'Dosen@edit_pass', 'roles' => ['dosen']]);    
	Route::post('/store_update_pass/{nip}', ['as' => 'dosen.store_update_pass', 'middleware' => ['roles'], 'uses' => 'Dosen@store_update_pass', 'roles' => ['dosen']]);    
	Route::post('/edit_profile/{id}', ['as' => 'dosen.edit_profile', 'middleware' => ['roles'], 'uses' => 'Dosen@edit_profile', 'roles' => ['dosen']]);	

	Route::group(['prefix' => 'transactions'], function()
	{
		Route::get('/topik_ta_mhs', ['as' => 'dosen.transactions.topik_ta_mhs', 'uses' => 'Dosen@topik_ta_mhs',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/topik_ta_mhs/{id}', ['as' => 'dosen.transactions.detail_topik_ta_mhs', 'uses' => 'Dosen@detail_topik_ta_mhs',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::post('/topik_ta_mhs/{id}/approved', ['as' => 'dosen.transactions.approved_topik_ta_mhs', 'uses' => 'Dosen@approved_topik_ta_mhs',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		Route::get('/perpanjang_sempro/{id}/approved', ['as' => 'dosen.transactions.approved_perpanjang_sempro', 'uses' => 'Dosen@approved_perpanjang_sempro',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/mhs_akademik', ['as' => 'dosen.transactions.mhs_akademik', 'uses' => 'Dosen@mhs_akademik',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/mhs_skripsi', ['as' => 'dosen.transactions.mhs_skripsi', 'uses' => 'Dosen@mhs_skripsi',  'middleware' => ['roles'], 'roles' => ['dosen']]);		
		Route::get('/jadwal_menguji', ['as' => 'dosen.transactions.jadwal_menguji', 'uses' => 'Dosen@jadwal_menguji',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/jadwal_menguji_ta_2', ['as' => 'dosen.transactions.jadwal_menguji_ta_2', 'uses' => 'Dosen@jadwal_menguji_ta_2',  'middleware' => ['roles'], 'roles' => ['dosen']]);		


		Route::get('/perpanjang_waktu', ['as' => 'dosen.transactions.perpanjang_waktu', 'uses' => 'Dosen@perpanjang_waktu',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/perpanjang_waktu/{id}/approved', ['as' => 'dosen.transactions.approved_perpanjang_waktu', 'uses' => 'Dosen@approved_perpanjang_waktu',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		Route::get('/mahasiswa_bimbingan', ['as' => 'dosen.transactions.mahasiswa_bimbingan', 'uses' => 'Dosen@mahasiswa_bimbingan',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		//konfirmasi perpanjang Sempro
		Route::get('/konfimasi_perpanjang_ta_1', ['as' => 'dosen.transactions.konfimasi_perpanjang_ta_1', 'uses' => 'Dosen@konfimasi_perpanjang_ta_1',  'middleware' => ['roles'], 'roles' => ['dosen']]);	
		Route::get('/konfirmasi_sempro_mhs/{id}', ['as' => 'dosen.transactions.detail_konfirmasi_sempro_mhs', 'uses' => 'Dosen@detail_konfimasi_perpanjang_ta',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::post('/konfirmasi_sempro_mhs/{id}/approved', ['as' => 'dosen.transactions.approved_sempro_mhs', 'uses' => 'Dosen@konfimasi_perpanjang_ta_approved',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		//konfirmasi pembimbing TA
		Route::get('/konfimasi_pembimbing_ta', ['as' => 'dosen.transactions.konfimasi_pembimbing_ta', 'uses' => 'Dosen@konfimasi_pembimbing_ta',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		// TA / SEMPRO / KOMFRE (PENGUJI & PEMBIMBING)
		//
		Route::get('/konfimasi_perpanjang_ta_2', ['as' => 'dosen.transactions.konfimasi_perpanjang_ta_2', 'uses' => 'Dosen@konfimasi_perpanjang_ta_2',  'middleware' => ['roles'], 'roles' => ['dosen']]);	
		Route::get('/konfirmasi_kompre_mhs/{id}', ['as' => 'dosen.transactions.detail_konfirmasi_kompre_mhs', 'uses' => 'Dosen@detail_konfimasi_perpanjang_ta_2',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::post('/konfirmasi_kompre_mhs/{id}/approved', ['as' => 'dosen.transactions.approved_kompre_mhs', 'uses' => 'Dosen@konfimasi_perpanjang_ta_2_approved',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		Route::get('/pendaftaran_skripsi', ['as' => 'dosen.transactions.pendaftaran_skripsi', 'uses' => 'Ta_2@pendaftaran_skripsi',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/konfirmasi_jadwal_sempro', ['as' => 'dosen.transactions.konfirmasi_jadwal_sempro', 'uses' => 'Ta_1@konfirmasi_jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/konfimasi_jadwal_kompre', ['as' => 'dosen.transactions.konfimasi_jadwal_kompre', 'uses' => 'Ta_2@konfimasi_jadwal_kompre',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		Route::get('/konfirmasi_jadwal', ['as' => 'dosen.transactions.konfirmasi_jadwal', 'uses' => 'Dosen@konfirmasi_jadwal',  'middleware' => ['roles'], 'roles' => ['dosen']]);

		Route::get('/jadwal_sempro', ['as' => 'dosen.transactions.jadwal_sempro', 'uses' => 'Dosen@jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/jadwal_skripsi', ['as' => 'dosen.transactions.jadwal_skripsi', 'uses' => 'Dosen@jadwal_skripsi',  'middleware' => ['roles'], 'roles' => ['dosen']]);	

		Route::get('/konfirmasi_perpanjang_sempro_dosen', ['as' => 'dosen.transactions.konfirmasi_perpanjang_sempro_dosen', 'uses' => 'Dosen@konfirmasi_perpanjang_sempro_dosen',  'middleware' => ['roles'], 'roles' => ['dosen']]);
		Route::get('/konfirmasi_perpanjang_kompre_dosen', ['as' => 'dosen.transactions.konfirmasi_perpanjang_kompre_dosen', 'uses' => 'Dosen@konfirmasi_perpanjang_kompre_dosen',  'middleware' => ['roles'], 'roles' => ['dosen']]);		
		Route::post('/store_konfirmasi_jadwal_sempro_no/{id}', ['as' => 'dosen.transactions.store_konfirmasi_jadwal_sempro_no', 'uses' => 'Dosen@store_konfirmasi_jadwal_sempro_no',  'middleware' => ['roles'], 'roles' => ['dosen']]);			
		Route::get('/store_konfirmasi_jadwal_sempro_yes/{id}', ['as' => 'dosen.transactions.store_konfirmasi_jadwal_sempro_yes', 'uses' => 'Dosen@store_konfirmasi_jadwal_sempro_yes',  'middleware' => ['roles'], 'roles' => ['dosen']]);	

		Route::post('/store_konfirmasi_jadwal_kompre_no/{id}', ['as' => 'dosen.transactions.store_konfirmasi_jadwal_kompre_no', 'uses' => 'Dosen@store_konfirmasi_jadwal_kompre_no',  'middleware' => ['roles'], 'roles' => ['dosen']]);			
		Route::get('/store_konfirmasi_jadwal_kompre_yes/{id}', ['as' => 'dosen.transactions.store_konfirmasi_jadwal_kompre_yes', 'uses' => 'Dosen@store_konfirmasi_jadwal_kompre_yes',  'middleware' => ['roles'], 'roles' => ['dosen']]);					
	});

});

// route for mhs module
Route::group(['prefix' => 'mhs'], function()
{
	Route::get('/', ['as' => 'mhs.dashboard', 'middleware' => ['roles'], 'uses' => 'Mhs@index', 'roles' => ['admin', 'mahasiswa']]);
	Route::get('/dashboard', ['as' => 'mhs.dashboard', 'middleware' => ['roles'], 'uses' => 'Mhs@index', 'roles' => ['admin', 'mahasiswa']]);
	Route::get('/profile', ['as' => 'mhs.profile', 'middleware' => ['roles'], 'uses' => 'Mhs@profile', 'roles' => ['admin', 'mahasiswa']]);
	Route::get('/edit_pass', ['as' => 'mhs.edit_pass', 'middleware' => ['roles'], 'uses' => 'Mhs@edit_pass', 'roles' => ['admin', 'mahasiswa']]);    
	Route::post('/store_update_pass/{nim}', ['as' => 'mhs.store_update_pass', 'middleware' => ['roles'], 'uses' => 'Mhs@store_update_pass', 'roles' =>  ['admin', 'mahasiswa']]);

	Route::post('/edit_profile/{id}', ['as' => 'mhs.edit_profile', 'middleware' => ['roles'], 'uses' => 'Mhs@edit_profile', 'roles' => ['admin', 'mahasiswa']]);
	Route::get('/view_upload_kkt_file', ['as' => 'mhs.view_upload_kkt_file', 'middleware' => ['roles'], 'uses' => 'Mhs@view_upload_kkt_file', 'roles' => ['admin', 'mahasiswa']]);

	// route for sempro module
	Route::group(['prefix' => 'transactions'], function()
	{
		Route::get('/form_pengajuan_topik', ['as' => 'mhs.transactions.form_pengajuan_topik', 'uses' => 'Ta_1@form_pengajuan_topik',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/form_perubahan_topik', ['as' => 'mhs.transactions.form_perubahan_topik', 'middleware' => ['roles'], 'uses' => 'Ta_1@form_perubahan_topik', 'roles' => ['mahasiswa']]);
        Route::post('/store_mhs_topik', ['as' => 'mhs.transactions.store_mhs_topik', 'middleware' => ['roles'], 'uses' => 'Ta_1@store_mhs_topik', 'roles' => ['mahasiswa']]);        
        Route::post('/store_mhs_sempro', ['as' => 'mhs.transactions.store_mhs_sempro', 'middleware' => ['roles'], 'uses' => 'Ta_1@store_mhs_sempro', 'roles' => ['mahasiswa']]);        
        Route::post('/store_mhs_pendaftaran_sempro', ['as' => 'mhs.transactions.store_mhs_pendaftaran_sempro', 'middleware' => ['roles'], 'uses' => 'Ta_1@store_mhs_pendaftaran_sempro', 'roles' => ['mahasiswa']]);        
        Route::post('/store_mhs_pendaftaran_kompre', ['as' => 'mhs.transactions.store_mhs_pendaftaran_kompre', 'middleware' => ['roles'], 'uses' => 'Ta_2@store_mhs_pendaftaran_kompre', 'roles' => ['mahasiswa']]);        
		Route::post('/form_perubahan_topik', ['as' => 'mhs.transactions.update_perubahan_topik', 'middleware' => ['roles'], 'uses' => 'Ta_1@update_perubahan_topik', 'roles' => ['mahasiswa']]);
		Route::get('/form_perpanjangan_waktu', ['as' => 'mhs.transactions.form_perpanjangan_waktu', 'middleware' => ['roles'], 'uses' => 'Ta_1@form_perpanjangan_waktu', 'roles' => ['mahasiswa']]);
		Route::get('/form_perpanjang_sempro', ['as' => 'mhs.transactions.form_perpanjang_sempro', 'middleware' => ['roles'], 'uses' => 'Ta_1@form_perpanjang_sempro', 'roles' => ['mahasiswa']]);
		Route::get('/form_perpanjang_kompre', ['as' => 'mhs.transactions.form_perpanjang_kompre', 'middleware' => ['roles'], 'uses' => 'Ta_2@form_perpanjang_kompre', 'roles' => ['mahasiswa']]);
		Route::get('/pendaftaran_sempro', ['as' => 'mhs.transactions.pendaftaran_sempro', 'middleware' => ['roles'], 'uses' => 'Ta_1@pendaftaran_sempro', 'roles' => ['mahasiswa']]);
		Route::get('/pendaftaran_kompre', ['as' => 'mhs.transactions.pendaftaran_kompre', 'middleware' => ['roles'], 'uses' => 'Ta_2@pendaftaran_kompre', 'roles' => ['mahasiswa']]);
		Route::get('/pengajuan_sk_ta', ['as' => 'mhs.transactions.pengajuan_sk_ta', 'middleware' => ['roles'], 'uses' => 'Ta_2@pengajuan_sk_ta', 'roles' => ['mahasiswa']]);
		Route::get('/status_sempro', ['as' => 'mhs.transactions.status_sempro', 'uses' => 'Mhs@status_sempro',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		// Route::get('/verifikasi_seminar', ['as' => 'mhs.transactions.verifikasi_seminar', 'uses' => 'Mhs@verifikasi_seminar',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/jadwal_sempro', ['as' => 'mhs.transactions.jadwal_sempro', 'uses' => 'Mhs@jadwal_sempro',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/form_pengajuan_sk_sempro', ['as' => 'mhs.transactions.form_pengajuan_sk_sempro', 'uses' => 'Mhs@form_pengajuan_sk_sempro',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/form_pengajuan_sk_kompre', ['as' => 'mhs.transactions.form_pengajuan_sk_kompre', 'uses' => 'Mhs@form_pengajuan_sk_kompre',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::post('/store_mhs_perpanjang_sk_sempro', ['as' => 'mhs.transactions.store_mhs_perpanjang_sk_sempro', 'uses' => 'Mhs@store_mhs_perpanjang_sk_sempro',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::post('/store_mhs_perpanjang_sk_kompre', ['as' => 'mhs.transactions.store_mhs_perpanjang_sk_kompre', 'uses' => 'Mhs@store_mhs_perpanjang_sk_kompre',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);

		// TA
		Route::get('/verifikasi_skripsi', ['as' => 'mhs.transactions.verifikasi_skripsi', 'uses' => 'Mhs@verifikasi_skripsi',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/status_kompre', ['as' => 'mhs.transactions.status_kompre', 'uses' => 'Mhs@status_kompre',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::get('/jadwal_kompre', ['as' => 'mhs.transactions.jadwal_kompre', 'uses' => 'Mhs@jadwal_kompre',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);
		Route::post('/store_kkt_file', ['as' => 'mhs.transactions.store_kkt_file', 'uses' => 'Mhs@store_kkt_file',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);


		Route::post('/store_mhs_perpanjang_kompre', ['as' => 'mhs.transactions.store_mhs_perpanjang_kompre', 'uses' => 'Ta_2@store_mhs_perpanjang_kompre',  'middleware' => ['roles'], 'roles' => ['mahasiswa']]);


	});

});
