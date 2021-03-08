<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Mhs_model;
use App\Models\Dosen_model;
use App\Models\Ta_2;
use App\Models\Ta_1_model;
use App\Models\Ta_1_history;
use App\Models\Topik_ta_history;
use App\Models\History_penguji_ta_1;
use App\Models\Mhs_topik_ta;
use App\Models\Penguji_ta_1;
use App\Models\Penguji_ta_2;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\MhsPerpanjangSempro;
use App\Models\MhsPerpanjangTa_2;
use App\Models\Dosen_pembimbing;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;


class Pengelola extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$data['mhs_aktif'] = Mhs_model::where('status_aktif', 1)->count();
		$data['mhs_memenuhi_syarat'] = Mhs_model::where('status_kkt_file', 2)->count();
		$data['mhs_daftar_sempro'] = Ta_1_model::where('id_status_ta_1', 1)->count();
		$data['mhs_daftar_kompre'] = Ta_2::where('id_status_ta_2', 1)->count();
		$data['mhs_masih_proses'] = Ta_2::where('id_status_ta_2', 'NOT LIKE', 5)->count();
		$data['mhs_selesai'] = Ta_2::where('id_status_ta_2', 5)->count();		
		
		if ($data['mhs_selesai'] == 0) {
			$data['mhs_selesai'] = 1;
		}	
		$jumlah_mhs = Mhs_model::count();
		if ($jumlah_mhs == 0) {
			$jumlah_mhs = 1;
		}
		$persen = $data['mhs_selesai']/$jumlah_mhs * 100;
		$data['persen'] = $persen;

		return view('pengelola.general.dashboard', $data);
	}

	public function mhs_memenuhi_syarat()
	{
		$data['mhs_memenuhi_syarat'] = Mhs_model::with('nip_dosen')->where('status_kkt_file', 2)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('pengelola.transactions.mhs_memenuhi_syarat', $data);
	}

	public function mhs_tidak_memenuhi_syarat()
	{
		$data['mhs_tidak_memenuhi_syarat'] = Mhs_model::with('nip_dosen')->where('status_kkt_file', 3)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();
		
		return view('pengelola.transactions.mhs_tidak_memenuhi_syarat', $data);
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

	public function mhs()
	{
		$data['mhs'] = Mhs_model::all();
		$data['tahun'] = Angkatan::select('id','angkatan')->get();
		$data['jurusan'] = Jurusan::select('id','jurusan')->get();
		return view('pengelola.transactions.mhs', $data);
	}

	public function dosen()
	{
		$data['dosen'] = Dosen_model::all();
		return view('pengelola.transactions.dosen', $data);
	}

	public function verifikasi_sukses()
	{
		$data['verifikasi_sukses'] 		= Mhs_model::with('nip_dosen')->where('status_kkt_file', 2)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('pengelola.transactions.verifikasi_sukses', $data);
	}	

	public function verifikasi_gagal()
	{
		$data['verifikasi_gagal'] 		= Mhs_model::with('nip_dosen')->where('status_kkt_file', 3)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();
		
		return view('pengelola.transactions.verifikasi_gagal', $data);
	}	

	public function set_pembimbing_skripsi()
	{
		$data['set_pembimbing_skripsi'] = Dosen_model::all();
		return view('pengelola.transactions.set_pembimbing_skripsi', $data);
	}

	public function penguji_sempro()
	{
		$data['penguji_sempro'] = Ta_1_model::with('join_mhs')->where('id_status_ta_1', 2)->get();
		return view('pengelola.transactions.penguji_sempro', $data);
	}	

	public function konfirmasi_perpanjang_sempro_dosen()
	{
		$data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::select('mhs_perpanjang_sempro.*', 'mhs.*', 'mhs.nama as mhs_name', 'dosen.nama as dosen_name', 'dosen.*')->join('mhs', 'mhs.nim', '=', 'mhs_perpanjang_sempro.nim')->join('dosen', 'dosen.nip', '=', 'mhs.nip_pa')->get();

		// return $data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::with('sempro', 'join_mhs', 'join_dosen')->get();
		return view('pengelola.transactions.konfirmasi_perpanjang_sempro_dosen', $data);
	}

	public function konfirmasi_perpanjang_kompre_dosen()
	{
		$data['konfirmasi_pembimbing'] = MhsPerpanjangTa_2::select('mhs_perpanjang_ta_2.*', 'mhs.*', 'mhs.nama as mhs_name', 'dosen.nama as dosen_name', 'dosen.*')->join('mhs', 'mhs.nim', '=', 'mhs_perpanjang_ta_2.nim')->join('dosen', 'dosen.nip', '=', 'mhs.nip_pa')->get();

		// return $data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::with('sempro', 'join_mhs', 'join_dosen')->get();
		return view('pengelola.transactions.konfirmasi_perpanjang_kompre_dosen', $data);
	}		

	public function status_sempro()
	{
		$data['status_sempro'] = Ta_1_model::select('ta_1.*', 'penguji_ta_1.status_agree_penguji', 'dosen.*', 'mhs.nama as nama_mahasiswa', 'mhs.nim as nim_mahasiswa', 'mhs_topik_ta.judul_ta as judul_ta')->join('mhs', 'mhs.nim','=','ta_1.nim')->join('penguji_ta_1', 'penguji_ta_1.nim', '=', 'ta_1.nim')->join('dosen', 'penguji_ta_1.nip', '=', 'dosen.nip')->join('mhs_topik_ta', 'ta_1.nim', '=', 'mhs_topik_ta.nim')->groupBy('nim')->get();
		return view('pengelola.transactions.status_sempro', $data);
	}		

	public function status_kompre()
	{
		$data['status_kompre'] = Ta_2::select('ta_2.*', 'penguji_ta_2.status_agree_penguji', 'dosen.*', 'mhs.nama as nama_mahasiswa', 'mhs.nim as nim_mahasiswa')->join('mhs', 'mhs.nim','=','ta_2.nim')->join('penguji_ta_2', 'penguji_ta_2.nim', '=', 'ta_2.nim')->join('dosen', 'penguji_ta_2.nip', '=', 'dosen.nip')->groupBy('nim')->get();
		return view('pengelola.transactions.status_kompre', $data);
	}	

	public function menyetujui_topik_ta()
	{
		$data['topik_ta'] = Mhs_topik_ta::with('topik_ta')->get();
		// $data['topik_ta'] = Mhs_topik_ta::select('mhs_topik_ta.*', 'topik_ta.*', 'ta_1.*')->join('topik_ta', 'mhs_topik_ta.id_topik_ta', '=', 'topik_ta.id')->join('ta_1', 'mhs_topik_ta.nim', '=', 'ta_1.nim')->where('id_status_ta_1', 'NOT LIKE', '5')->get();
		return view('pengelola.transactions.menyetujui_topik_ta', $data);
	}							

	public function menyetujui_topik_ta_update(Request $request, $id)
	{
		$mhs = Mhs_topik_ta::find($id);
		$mhs->id_status_agree_topik = $request->status;
		$mhs->update();
		$data['topik_ta'] = Mhs_topik_ta::with('topik_ta')->get();
		return view('pengelola.transactions.menyetujui_topik_ta', $data);
	}							

	public function detail_sempro($id)
	{
		$data = Ta_1_model::select('ta_1.*', 'penguji_ta_1.status_agree_penguji', 'dosen.*', 'mhs.nama as nama_mahasiswa', 'mhs.nim as nim_mahasiswa','mhs_topik_ta.*')->join('mhs_topik_ta', 'mhs_topik_ta.nim', '=', 'ta_1.nim')->join('mhs', 'mhs.nim','=','ta_1.nim')->join('penguji_ta_1', 'penguji_ta_1.nim', '=', 'ta_1.nim')->join('dosen', 'penguji_ta_1.nip', '=', 'dosen.nip')->get();
		return json_encode($data);
	}

	public function detail_kompre($id)
	{
		$data = Ta_2::select('ta_2.*', 'penguji_ta_2.status_agree_penguji', 'dosen.*', 'mhs.nama as nama_mahasiswa', 'mhs.nim as nim_mahasiswa','mhs_topik_ta.*')->join('mhs_topik_ta', 'mhs_topik_ta.nim', '=', 'ta_2.nim')->join('mhs', 'mhs.nim','=','ta_2.nim')->join('penguji_ta_2', 'penguji_ta_2.nim', '=', 'ta_2.nim')->join('dosen', 'penguji_ta_2.nip', '=', 'dosen.nip')->get();
		return json_encode($data);
	}


	public function konfirmasi_penguji_kompre()
	{
		// $data['ta_2'] = Ta_2::all();
		$data['penguji_ta_2'] = Penguji_ta_2::with('dosen')->get();	
		return view('pengelola.transactions.konfirmasi_penguji_kompre', $data);
	}	

	public function konfirmasi_penguji_sempro()
	{
		$data['dosen'] = Dosen_model::all();
		$data['penguji_ta_1'] = Penguji_ta_1::with('dosen')->where('status_agree_penguji', 0)->get();
		return view('pengelola.transactions.konfirmasi_penguji_sempro', $data);
	}	
	
	public function penguji_sempro_mhs($id)
	{		
		// $data['mhs_join'] = Ta_1_model::with('join_pembimbing', 'join_pembimbing.join_dosen')->where('nim', $id)->first();
		$data['mhs'] = Ta_1_model::with('join_mhs')->where('nim', $id)->first();
		$data['topik_ta'] = Mhs_topik_ta::with('topik_ta')->where('nim', $id)->first();
		$data['pembimbing'] = Dosen_pembimbing::with('join_dosen')->where('nim', $id)->get();
		$data['dosen'] = Dosen_model::all();
		
		return view('pengelola.transactions.penguji_sempro_mhs', $data);
	}	

	public function store_mhs_penguji_sempro_mhs(Request $request)
	{
		$check = Penguji_ta_1::where('nim', $request->nim)->first();	
		if (empty($check)) {
			foreach ($request->penguji as $key => $value) {			
				$input = new Penguji_ta_1();
				$input['nim'] = $request->nim;
				$input['nip'] = $value;
				$input['created_by'] = Auth::user()->username;
				$input->save();
				# code...

				$insert = new History_penguji_ta_1();
				$insert['nim'] = $request->nim;		
				$insert['nip'] = $value;								
				$insert['created_by'] = Auth::user()->username;
				$insert['created_at'] = date('Y-m-d h:m:s');			
				$insert->save();
			}

			$change = Ta_1_model::where('nim', $request->nim)->first();
			$change['id_status_ta_1'] = 2;
			$change['updated_at'] = date('Y-m-d h:m:s');
			$change->update();

			$update = Ta_1_model::where('nim', $request->nim)->first();
			$update['id_status_ta_1'] = 4;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d h:m:s');
			$update->update();

			$insert_ta1_history = new Ta_1_history();
			$insert_ta1_history['nim'] = $request->nim;
			$insert_ta1_history['id_status_ta_1'] = 4;
			$insert_ta1_history['created_by'] = Auth::user()->username;
			$insert_ta1_history->save();
			// $data['penguji_sempro'] = Ta_1_model::where('id_status_ta_1', 1)->get();


			return redirect()->route('pengelola.transactions.penguji_sempro')->withInput()->withMessage('Penguji berhasil di set !');
		}else{
			return redirect()->route('pengelola.transactions.penguji_sempro')->withInput()->withMessage('Penguji mhs ini sudah diset sebelumnya !');
		}
	}		

	public function setuju_topik_ta($nim)
	{
		# code...
		$data['mhs'] = Mhs_topik_ta::with('topik_ta')->where('nim', $nim)->first();
		$data['pembimbing'] = Dosen_pembimbing::with('join_dosen')->where('nim', $nim)->get();

		return view('pengelola.transactions.setuju_topik_ta', $data);
	}

	public function store_setuju_topik_ta_by_pengelola(Request $request)
	{
		# code...
		if ($request->persetujuan == 3) {
			# code...
        	$validator = Validator::make($request->all(), [
           		'ket' 	=> 'required'
			]);		
			if ($validator->fails()) {
				# code...
        		return redirect()->route('pengelola.transactions.setuju_topik_ta', $request->nim)->withInput()->withErrors($validator);
			}
			else{
				$update = Mhs_topik_ta::where('nim', $request->nim)->first();
				$update['id_status_agree_topik'] = $request->persetujuan;
				$update['ket'] = $request->ket;
				$update['updated_by'] = Auth::user()->username;
				$update['updated_at'] = date('Y-m-d H:m:s');
				$update->update();

				$insert = new Topik_ta_history();
				$insert['nim'] = $update->nim;
				$insert['id_topik_ta'] = $update->id_topik_ta;
				$insert['judul_ta'] = $update->judul_ta;
				$insert['id_status_agree_topik'] = $update->id_status_agree_topik;
				$insert['file_konsultasi'] = $update->file_konsultasi;
				$insert['ket'] = $request->ket;
				$insert['created_by'] = Auth::user()->username;
				$insert->save();

				return redirect()->route('pengelola.transactions.menyetujui_topik_ta')->withInput()->withMessage('Topik TA berhasil di update !');			
			}
		}else{
			$update = Mhs_topik_ta::where('nim', $request->nim)->first();
			$update['id_status_agree_topik'] = $request->persetujuan;
			$update['ket'] = $request->ket;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d H:m:s');
			$update->update();

			$insert = new Topik_ta_history();
			$insert['nim'] = $update->nim;
			$insert['id_topik_ta'] = $update->id_topik_ta;
			$insert['judul_ta'] = $update->judul_ta;
			$insert['id_status_agree_topik'] = $update->id_status_agree_topik;
			$insert['file_konsultasi'] = $update->file_konsultasi;
			$insert['ket'] = $request->ket;
			$insert['created_by'] = Auth::user()->username;
			$insert->save();

			return redirect()->route('pengelola.transactions.menyetujui_topik_ta')->withInput()->withMessage('Topik TA berhasil di update !');			

		}
	}

	public function ubah_penguji_mhs($id)
	{
		# code...
		// $data['mhs'] = Ta_1_model::with('join_mhs')->where('nim', $nim)->first();
		// $data['topik_ta'] = Mhs_topik_ta::with('topik_ta')->where('nim', $nim)->first();
		// $data['pembimbing'] = Dosen_pembimbing::where('nim', $nim)->get();
		// $data['dosen'] = Dosen_model::all();
		
		return $data['penguji'] = Penguji_ta_1::with('dosen')->where('id', $id)->get();
		return view('pengelola.transactions.ubah_penguji_mhs', $data);
	}

	public function store_ubah_penguji($id, Request $request)
	{
		# code...
		// return $request->all();
		$find = Penguji_ta_1::find($id);
		$find['nip'] = $request->dosen;
		$find['ket'] = $request->ket;		
		$find['updated_by'] = Auth::user()->username;
		$find['updated_at'] = date('Y-m-d H:m:s');
		$find->update();

		$insert = new History_penguji_ta_1();
		$insert['nim'] = $find->nim;
		$insert['nip'] = $request->dosen;
		$insert['ket'] = $request->ket;
		$insert['created_by'] = Auth::user()->username;		
		$insert->save();
		return redirect()->route('pengelola.transactions.konfirmasi_penguji_sempro')->withInput()->withMessage('Penguji Berhasil di update !');	
	}

	public function profile()
	{		
		$data['profile'] = User::where('username', Auth::user()->username)->first();
		return view('pengelola.general.profile', $data);
	}

    public function edit_profile(Request $request, $username)
    {    	
        $mhs                        = User::where('username', $username)->first();           
        $mhs->name         		   	= $request->nama;                       
        $mhs->update();

        return redirect()->route('pengelola.profile')->withInput()->withMessage('Profile success edited !');
    }	

	public function edit_pass()
	{
		# code...
		$data['profile'] = Auth::user()->username;
		return view('pengelola.general.edit_pass', $data);
	}

	public function store_update_pass(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
				'password' => 'required|min:6',              
            ]);
	
		if ($validator->fails()) {
            	return redirect()->route('pengelola.edit_pass')->withInput()->withMessage('Your password less from 6 characters !');              
        }else{
        	if ($request->password != $request->confirm_password) {
            	return redirect()->route('pengelola.edit_pass')->withInput()->withMessage('Your password doesn\'t match !');
			}else{
				$update_pass = User::where('username', $id)->first();
				$update_pass->password = bcrypt($request->password);
				$update_pass->update();

				return redirect()->route('pengelola.edit_pass')->withInput()->withMessage('Your password success updated !');
			}
        }
	}    
}

