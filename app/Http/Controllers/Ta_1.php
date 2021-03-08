<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ta_1_model;
use App\Models\Dosen_model;
use App\Models\Ta_2;
use App\Models\Topik_ta;
use App\Models\Ta_1_history;
use App\Models\Topik_ta_history;
use Auth;
use App\Models\Mhs_topik_ta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MhsPerpanjangSempro;
use App\Models\Mhs_perpanjang_sempro_history;
use App\Models\Penguji_ta_1;
use App\Models\Mhs_model;
use App\Models\Dosen_pembimbing;
use App\Models\Dosen_pembimbing_history;

class Ta_1 extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function form_pengajuan_topik()
	{
		$data['mhs'] = Mhs_model::where('nim', Auth::user()->username)->first();
		$data['data_ta'] 	= Mhs_topik_ta::where('nim', Auth::user()->username)->first();
		$data['topik_ta'] = Topik_ta::all();
		$data['dosen'] = Dosen_model::all();
		return view('mhs.transactions.form_pengajuan_topik', $data);
	}

	public function topik_ta()
	{
		$data['topik_ta'] = Ta_1_model::all();
		return view('sempro/topik_ta', $data);
	}

	public function form_perubahan_topik()
	{
		// $data['ta1'] 			= Ta_1_model::all();
		$data['topik_ta'] 		= Topik_ta::all();
		// $data['mhs_topik_ta'] 	= Mhs_topik_ta::join('status_agree_topik', 'mhs_topik_ta.id_status_agree_topik','=', 'status_agree_topik.id')->where('mhs_topik_ta.nim', Auth::user()->username)->first();
		$data['mhs_topik_ta'] 	= Mhs_topik_ta::where('nim', Auth::user()->username)->first();
		$data['dosen'] = Dosen_model::all();
		$tdate = Mhs_topik_ta::where('nim', Auth::user()->username)->first();
		if (!isset($tdate)) {
			# code...
			$froms = \Carbon\Carbon::now();
		}else{
			$froms = new \Carbon\Carbon($tdate->created_at);
		}
		
		$from = new \Carbon\Carbon($froms); 
		$to = \Carbon\Carbon::now();		

		$data['diff_day'] = $from->diffInDays($to);		
		$data['sisa'] = 30 - $from->diffInDays($to);		

		return view('mhs.transactions.form_perubahan_topik', $data);
	}

	public function update_perubahan_topik(Request $request)
	{

       	set_time_limit(0);

        $validator = Validator::make($request->all(), [
           'file_konsultasi' => 'required|max:10000',
           'id_topik_ta' => 'required',
           'judul_ta' => 'required',
           'id_status_agree_topik' => 'required',
        ]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_perubahan_topik')->withInput()->withErrors($validator);
       }else{
			$mhs_topik_ta 	= Mhs_topik_ta::where('mhs_topik_ta.nim', Auth::user()->username)->first();

	        $file 							= $request->file('file_konsultasi');
	        $fileName3 						= uniqid() . '.'. $file->getClientOriginalExtension();

	        $request->file('file_konsultasi')->move("assets/images/", $fileName3);

	        $mhs_topik_ta->file_konsultasi 	= $fileName3;
	        $mhs_topik_ta->id_topik_ta 		= $request->id_topik_ta;
	        $mhs_topik_ta->judul_ta 		= $request->judul_ta;
	        $mhs_topik_ta->updated_by		= Auth::user()->username;
	        $mhs_topik_ta->id_status_agree_topik	= 1;
	        $mhs_topik_ta->save();

	        $delete_pembimbing_sebelumnya = Dosen_pembimbing::where('nim', Auth::user()->username)->get();
	        foreach ($delete_pembimbing_sebelumnya as $key => $value) {
	        	$value->delete();
	        }

	        foreach ($request->dosen as $key => $value) {
	        	$calon_pembimbing = new Dosen_pembimbing();
	        	$calon_pembimbing['nim'] = Auth::user()->username;
	        	$calon_pembimbing['nip'] = $value;
	        	$calon_pembimbing['created_by'] = Auth::user()->username;
	        	$calon_pembimbing->save();

				$calon_pembimbing_history = new Dosen_pembimbing_history();
	        	$calon_pembimbing_history['nim'] = Auth::user()->username;
	        	$calon_pembimbing_history['nip'] = $value;
	        	$calon_pembimbing_history['created_by'] = Auth::user()->username;
	        	$calon_pembimbing_history->save();
	        }	        

            return redirect()->route('mhs.transactions.form_perubahan_topik')->withInput()->withMessage('Anda telah berhasil merubah Pengajuan TA !');


       }
	}

	public function status_sempro()
	{
		$data['status_sempro'] = Ta_1_model::all();
		return view('sempro/status_sempro', $data);
	}

	public function jadwal_sempro()
	{
		$data['jadwal_sempro'] = Ta_1_model::all();
		return view('sempro/jadwal_sempro', $data);
	}

	public function verifikasi_seminar()
	{
		$data['verifikasi_seminar'] = Ta_1_model::all();
		return view('sempro/verifikasi_seminar', $data);
	}

	public function perpanjang_sempro()
	{
		$data['perpanjang_sempro'] = Ta_1_model::all();
		return view('sempro/perpanjang_sempro', $data);
	}

	public function penguji_sempro()
	{
		$data['penguji_sempro'] = Ta_1_model::all();
		return view('sempro/penguji_sempro', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function store_mhs_topik(Request $request)
	{
		// return $request->all();		
       	set_time_limit(0);
        	$validator = Validator::make($request->all(), [
           'file_konsultasi' 	=> 'required|max:10000',
           'id_topik_ta' 		=> 'required',
           'judul_ta' 			=> 'required',
        	]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_pengajuan_topik')->withInput()->withErrors($validator);
       }else{
       		$mhs_topik_ta 	= Mhs_topik_ta::where('nim', Auth::user()->username)->first();

				if (empty($mhs_topik_ta)) {
       			$mhs_topik_ta 	= new Mhs_topik_ta();

		        $file 				= $request->file('file_konsultasi');
		        $fileName3 		= uniqid() . '.'. $file->getClientOriginalExtension();
		        $request->file('file_konsultasi')->move("assets/images/", $fileName3);

		        $mhs_topik_ta->nim 					= Auth::user()->username;
		        $mhs_topik_ta->file_konsultasi 		= $fileName3;
		        $mhs_topik_ta->id_topik_ta 			= $request->id_topik_ta;
		        $mhs_topik_ta->judul_ta 			= $request->judul_ta;
		        $mhs_topik_ta->created_by			= Auth::user()->username;
		        $mhs_topik_ta->id_status_agree_topik	= 1;
		        $mhs_topik_ta->save();

				$topik_ta_history 	= new Topik_ta_history();
		        $topik_ta_history->nim 	= Auth::user()->username;
		        $topik_ta_history->file_konsultasi 	= $fileName3;
		        $topik_ta_history->id_topik_ta 		= $request->id_topik_ta;
		        $topik_ta_history->judul_ta 		= $request->judul_ta;
		        $topik_ta_history->created_by		= Auth::user()->username;
		        $topik_ta_history->id_status_agree_topik	= 1;
		        $topik_ta_history->save();
		       	
		        foreach ($request->dosen as $key => $value) {
		        	$calon_pembimbing = new Dosen_pembimbing();
		        	$calon_pembimbing['nim'] = Auth::user()->username;
		        	$calon_pembimbing['nip'] = $value;
		        	$calon_pembimbing['created_by'] = Auth::user()->username;
		        	$calon_pembimbing->save();

					$calon_pembimbing_history = new Dosen_pembimbing_history();
		        	$calon_pembimbing_history['nim'] = Auth::user()->username;
		        	$calon_pembimbing_history['nip'] = $value;
		        	$calon_pembimbing_history['created_by'] = Auth::user()->username;
		        	$calon_pembimbing_history->save();
		        }

					// $ta_1 	= new Ta_1_model();
		   //      	$ta_1->nim 	= Auth::user()->username;
		   //      	$ta_1->created_by		= Auth::user()->username;
		   //      	$ta_1->save();

					// $ta_1_history 	= new Ta_1_history();
		   //      	$ta_1_history->nim 	= Auth::user()->username;
		   //      	$ta_1_history->created_by		= Auth::user()->username;
		   //      	$ta_1_history->save();
	            return redirect()->route('mhs.transactions.form_pengajuan_topik')->withInput()->withMessage('Anda telah berhasil melakukan Pengajuan TA !');
	       	}

       }
	}


	public function store_mhs_sempro(Request $request)
	{		

       	set_time_limit(0);
        	$validator = Validator::make($request->all(), [
           'file_konsultasi' 	=> 'required|max:10000'
			]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_perpanjang_sempro')->withInput()->withErrors($validator);
       }else{
       		$mhs_sempro_ta 	= MhsPerpanjangSempro::where('nim', Auth::user()->username)->first();
			$topik_ta = Mhs_topik_ta::where('nim',Auth::user()->username)->first();
			
				if (empty($mhs_sempro_ta)) {
       			$mhs_sempro_ta 	= new MhsPerpanjangSempro();

		        $file 				= $request->file('file_konsultasi');
		        $fileName3 		= uniqid() . '.'. $file->getClientOriginalExtension();
		        $request->file('file_konsultasi')->move("assets/images/", $fileName3);

		        $mhs_sempro_ta->nim 					= Auth::user()->username;
		        $mhs_sempro_ta->id_topik_ta 			= $topik_ta->id_topik_ta;
		        $mhs_sempro_ta->judul_ta 			= $topik_ta->judul_ta;
		        $mhs_sempro_ta->id_status_agree_perpanjang 			= 1; //artinya menunngu konfirmasi
		        $mhs_sempro_ta->file_perpanjang 	= $fileName3;
		        $mhs_sempro_ta->created_by			= Auth::user()->username;
				$mhs_sempro_ta->save();
				
				} else {
				
		        $file 				= $request->file('file_konsultasi');
		        $fileName3 		= uniqid() . '.'. $file->getClientOriginalExtension();
		        $request->file('file_konsultasi')->move("assets/images/", $fileName3);
				$mhs_sempro_ta->file_perpanjang 	= $fileName3;
				$mhs_sempro_ta->update();

				}

				$topik_ta_history 	= new Mhs_perpanjang_sempro_history();
		        $topik_ta_history->nim 	= Auth::user()->username;
		        $topik_ta_history->id_topik_ta 		= $topik_ta->id_topik_ta;
		        $topik_ta_history->judul_ta 		= $topik_ta->judul_ta;
		        $topik_ta_history->id_status_agree_perpanjang 	= 1;
		        $topik_ta_history->file_perpanjang 	= $fileName3;
		        $topik_ta_history->save();

	            return redirect()->route('mhs.transactions.form_perpanjang_sempro')->withInput()->withMessage('Anda telah berhasil melakukan Perpanjang Sempro !');
       }
	}


	public function store_mhs_pendaftaran_sempro(Request $request)
	{		
       	$mhs_sempro_ta 	= Ta_1_model::where('nim', Auth::user()->username)->first();
			
		if (empty($mhs_sempro_ta)) {
			$mhs_sempro_ta 	= new Ta_1_model();
        $mhs_sempro_ta->nim 					= Auth::user()->username;
        $mhs_sempro_ta->created_by			= Auth::user()->username;
		$mhs_sempro_ta->save();
		
		$topik_ta_history 	= new Ta_1_history();
		$topik_ta_history->nim 	= Auth::user()->username;
		$topik_ta_history->created_by 	= Auth::user()->username;
		$topik_ta_history->save();
		
		return redirect()->route('mhs.transactions.pendaftaran_sempro')->withInput()->withMessage('Anda berhasil melakukan Pendaftaran Sempro !');

		} else {
		
			return redirect()->route('mhs.transactions.pendaftaran_sempro')->withInput()->withMessage('Anda sudah melakukan Pendaftaran Sempro !');
       
		}
	}

	public function form_perpanjang_sempro()
	{
		# code...
		$data['mhs'] = MhsPerpanjangSempro::where('nim', Auth::user()->username)->first();
		return view('mhs.sempro.form_perpanjang_sempro', $data);
	}	

	public function pendaftaran_sempro()
	{ 
		$data['mhs_topik_ta'] = Mhs_topik_ta::where('nim', Auth::user()->username)->first();
		$data['pendaftaran_sempro'] = Ta_1_model::where('nim',Auth::user()->username)->first();
		return view('mhs.sempro.pendaftaran_sempro', $data);
	}	

	public function form_perpanjang_kompre()
	{
		# code...
		return view('mhs.transactions.form_perpanjang_kompre');
	}	

    public function konfirmasi_jadwal_sempro()
	{
		# code...
		$data['mhs'] = Penguji_ta_1::with('ta_1')->where('nip', Auth::user()->username)->where('status_agree_penguji', 0)->get();
		return view('dosen.transactions.konfimasi_jadwal_sempro', $data);
	}
}
