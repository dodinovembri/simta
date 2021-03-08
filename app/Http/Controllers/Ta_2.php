<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MhsPerpanjangTa_2;
use App\Models\MhsPerpanjangTa_2_history	;
use Auth;
use App\Models\Topik_ta;
use App\Models\Mhs_topik_ta;
use App\Models\Ta_1_model;
use App\Models\Penguji_ta_1;
use App\Models\Penguji_ta_2;
use App\Models\Ta_2 as Ta_2_model;
use App\Models\Ta_2_history;



use Illuminate\Http\Request;

class Ta_2 extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function data_prasyarat_ta()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function status_skripsi()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function jadwal_skripsi()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function verifikasi_skripsi()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function perpanjang_skripsi()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}

	public function pendaftaran_skripsi()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
	}
	
	public function jadwal_penguji()
	{
		$data['dosen'] = Dosen_model::all();
		return view('dosen/index', $data);
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

	public function form_perpanjang_kompre()
	{
		# code...
		$data['mhs'] = MhsPerpanjangTa_2::where('nim', Auth::user()->username)->first();		
		return view('mhs.kompre.form_perpanjang_kompre', $data);
	}	

	public function store_mhs_perpanjang_kompre(Request $request)
	{		

       	set_time_limit(0);
        	$validator = Validator::make($request->all(), [
           'file_konsultasi' 	=> 'required|max:10000'
			]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_perpanjang_kompre')->withInput()->withErrors($validator);
       }else{
       		$mhs_sempro_ta 	= MhsPerpanjangTa_2::where('nim', Auth::user()->username)->first();
			$topik_ta = Mhs_topik_ta::where('nim',Auth::user()->username)->first();
			
				if (empty($mhs_sempro_ta)) {
       			$mhs_sempro_ta 	= new MhsPerpanjangTa_2();

		        $file 				= $request->file('file_konsultasi');
		        $fileName3 		= uniqid() . '.'. $file->getClientOriginalExtension();
		        $request->file('file_konsultasi')->move("assets/images/", $fileName3);

		        $mhs_sempro_ta->nim 					= Auth::user()->username;
		        $mhs_sempro_ta->id_topik_ta 			= $topik_ta->id_topik_ta;
		        $mhs_sempro_ta->judul_ta 			= $topik_ta->judul_ta;
		        $mhs_sempro_ta->id_status_agree_perpanjang 			= 1; 
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

				$topik_ta_history 	= new MhsPerpanjangTa_2_history();
		        $topik_ta_history->nim 	= Auth::user()->username;
		        $topik_ta_history->id_topik_ta 		= $topik_ta->id_topik_ta;
		        $topik_ta_history->judul_ta 		= $topik_ta->judul_ta;
		        $topik_ta_history->id_status_agree_perpanjang 	= 1;
		        $topik_ta_history->file_perpanjang 	= $fileName3;
		        $topik_ta_history->save();

	            return redirect()->route('mhs.transactions.form_perpanjang_kompre')->withInput()->withMessage('Anda telah berhasil melakukan Perpanjang Kompre !');
       }
	}	

    public function konfimasi_jadwal_kompre()
	{
		# code...		
		$data['mhs'] = Penguji_ta_2::with('ta_2')->where('nip', Auth::user()->username)->where('status_agree_penguji', 0)->get();	
		return view('dosen.transactions.konfimasi_jadwal_kompre', $data);		
	}

	public function pendaftaran_kompre()
	{
		# code...
		$data['is_sempro'] = Ta_1_model::where('id_status_ta_1', 5)->where('nim', Auth::user()->username)->first();
		$data['pendaftaran_kompre'] = Ta_2_model::where('nim',Auth::user()->username)->first();

		return view('mhs.kompre.pendaftaran_kompre', $data);
	}			

	public function store_mhs_pendaftaran_kompre(Request $request)
	{				
       	$mhs_kompre_ta 	= Ta_2_model::where('nim', Auth::user()->username)->first();
			
		if (empty($mhs_kompre_ta)) {
		$mhs_kompre_ta 					= new Ta_2_model();
        $mhs_kompre_ta->nim 			= Auth::user()->username;
        $mhs_kompre_ta->created_by		= Auth::user()->username;
		$mhs_kompre_ta->save();
		
		$topik_ta_history 				= new Ta_2_history();
		$topik_ta_history->nim 			= Auth::user()->username;
		$topik_ta_history->created_by 	= Auth::user()->username;
		$topik_ta_history->save();
		
		return redirect()->route('mhs.transactions.pendaftaran_kompre')->withInput()->withMessage('Anda berhasil melakukan Pendaftaran Kompre !');

		} else {
		
			return redirect()->route('mhs.transactions.pendaftaran_sempro')->withInput()->withMessage('Anda sudah melakukan Pendaftaran Kompre !');
       
		}
	}

}
