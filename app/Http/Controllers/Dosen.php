<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Models\Dosen_model;
use App\Models\Mhs_topik_ta;
use Illuminate\Http\Request;
use App\Models\Topik_ta_history;
use App\Models\History_penguji_ta_1;
use App\Models\History_penguji_ta_2;
use App\Models\MhsPerpanjangSempro;
use App\Models\MhsPerpanjangTa_2;
use App\Models\Dosen_pembimbing;
use App\Models\Penguji_ta_1;
use App\Models\Penguji_ta_2;
use App\Models\Ta_1_model;
use App\Models\Ta_2;
use App\Models\Mhs_model;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class Dosen extends Controller {

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

		$data['dosen'] = Dosen_model::all();
		return view('dosen.general.dashboard', $data);
	}

	public function topik_ta_mhs()
	{
		$data['topik_ta_mhs'] = Mhs_topik_ta::select('mhs_topik_ta.*')->join('mhs', 'mhs_topik_ta.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_topik_ta.id_status_agree_topik', '=', 1)->where('dosen.nip', '=', Auth::user()->username)->get();
		return view('dosen.transactions.topik_ta_mhs', $data);
	}

	public function set_pembimbing_skripsi()
	{
		$data['set_pembimbing_skripsi'] = Mhs_topik_ta::where('id_status_agree_topik', 1)->get();
		return view('dosen/set_pembimbing_skripsi', $data);
	}

	public function detail_topik_ta_mhs($id)
	{
		$data['topik_ta_mhs'] = Mhs_topik_ta::where('id', $id)->first();		
		return view('dosen.transactions.topik_ta_mhs_detail', $data);
	}


	public function approved_topik_ta_mhs(Request $request, $id)
	{

       	set_time_limit(0);
       	if( $request->status_approve_ta == 2 ){
       		$validator = Validator::make($request->all(), [
	           'notes' => 'required',
	        ]);       
       	}else{
       		$validator = Validator::make($request->all(), [

       		]);   
       	}

       	if ($validator->fails()) {
            return redirect()->route('dosen.transactions.detail_topik_ta_mhs', $id)->withInput()->withErrors($validator);
       	}else{
			$mhs_topik_ta 	= Mhs_topik_ta::where('id', $id)->first();

	        $mhs_topik_ta->updated_by				= Auth::user()->username;
	        $mhs_topik_ta->id_status_agree_topik	= $request->status_approve_ta;	
	        if( $request->status_approve_ta == 2 ) {
	        	$mhs_topik_ta->ket = $request->notes;
	        }

	        $mhs_topik_ta->save();
	        $topik_ta_history 					= new Topik_ta_history();
	        $topik_ta_history->nim 				= $mhs_topik_ta->nim;
	        $topik_ta_history->file_konsultasi 	= $mhs_topik_ta->file_konsultasi;
	        $topik_ta_history->id_topik_ta 		= $mhs_topik_ta->id_topik_ta;
	        $topik_ta_history->judul_ta 		= $mhs_topik_ta->judul_ta;
	        $topik_ta_history->created_by		= Auth::user()->username;
	        $topik_ta_history->id_status_agree_topik = $mhs_topik_ta->id_status_agree_topik;
	        $topik_ta_history->save();

            return redirect()->route('dosen.transactions.topik_ta_mhs')->withMessage('Anda telah berhasil mengupdate Persetujuan TA !');
       }	       
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

	public function mhs_akademik()
	{
		# code...
		// $data['mhs'] = Mhs_model::where('nip_pa', Auth::user()->username)->get();
		$data['mhs'] = Mhs_model::select('mhs.*', 'angkatan.angkatan as angkatan', 'jurusan.jurusan as jurusan')->join('angkatan', 'mhs.id_angkatan', '=', 'angkatan.id')->join('jurusan', 'mhs.id_jurusan', '=', 'jurusan.id')->where('nip_pa', '=',  Auth::user()->username)->get();
		return view('dosen.transactions.mhs_akademik', $data);
	}

	public function mhs_skripsi()
	{
		# code...
		// $data['mhs'] = Dosen_pembimbing::where('nip', Auth::user()->username)->get();
		$data['mhs'] = Dosen_pembimbing::select('dosen_pembimbing.*', 'mhs.*', 'angkatan.angkatan as angkatan', 'jurusan.jurusan as jurusan')->join('mhs', 'dosen_pembimbing.nim', '=', 'mhs.nim')->join('angkatan', 'mhs.id_angkatan', '=', 'angkatan.id')->join('jurusan', 'mhs.id_jurusan', '=', 'jurusan.id')->where('nip', '=',  Auth::user()->username)->get();		
		return view('dosen.transactions.mhs_skripsi', $data);
	}	

	public function jadwal_menguji()
	{
		# code...
		$data['dosen'] = Penguji_ta_1::select('penguji_ta_1.*', 'ta_1.*')->join('ta_1', 'penguji_ta_1.nim', '=', 'ta_1.nim')->where('penguji_ta_1.nip', '=', Auth::user()->username)->where('penguji_ta_1.status_agree_penguji', 1)->where('ta_1.id_status_ta_1', '=', 7)->get();
		return view('dosen.transactions.jadwal_menguji', $data);
	}

	public function jadwal_menguji_ta_2()
	{
		# code...
		$data['dosen'] = Penguji_ta_2::where('nip', Auth::user()->username)->where('status_agree_penguji', 1)->get();
		return view('dosen.transactions.jadwal_menguji_ta_2', $data);
	}			

	public function konfimasi_perpanjang_ta_1()
	{
		$data['perpanjang_sempro'] = MhsPerpanjangSempro::select('mhs_perpanjang_sempro.*')->join('mhs', 'mhs_perpanjang_sempro.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_perpanjang_sempro.id_status_agree_perpanjang', '=', 1)->where('dosen.nip', '=', Auth::user()->username)->get();
		return view('dosen.transactions.perpanjang_sempro', $data);
	}

	public function konfimasi_perpanjang_ta_2()
	{
		$data['perpanjang_kompre'] = MhsPerpanjangTa_2::select('mhs_perpanjang_ta_2.*')->join('mhs', 'mhs_perpanjang_ta_2.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_perpanjang_ta_2.id_status_agree_perpanjang', '=', 1)->where('dosen.nip', '=', Auth::user()->username)->get();
		return view('dosen.transactions.perpanjang_kompre', $data);
	}	

	public function detail_konfimasi_perpanjang_ta($id)
	{
		$data['detail_sempro'] = MhsPerpanjangSempro::find($id);
		return view('dosen.transactions.detail_perpanjang_sempro', $data);
	}

	public function detail_konfimasi_perpanjang_ta_2($id)
	{
		$data['detail_kompre'] = MhsPerpanjangTa_2::find($id);
		return view('dosen.transactions.detail_perpanjang_kompre', $data);
	}	

	public function konfimasi_perpanjang_ta_approved(Request $request, $id)
	{

       	set_time_limit(0);
       	if( $request->status_approve_ta == 3 ){
       		$validator = Validator::make($request->all(), [
	           'notes' => 'required',
	        ]);       
       	}else{
       		$validator = Validator::make($request->all(), [

       		]);   
       	}

       	if ($validator->fails()) {
            return redirect()->route('dosen.transactions.detail_perpanjang_sempro', $id)->withInput()->withErrors($validator);
       	}else{
			$sempro 	= MhsPerpanjangSempro::where('id', $id)->first();

	        $sempro->updated_by				  = Auth::user()->username;
	        $sempro->id_status_agree_perpanjang = $request->status_approve_ta;	
	        if( $request->status_approve_ta == 2 ) {
	        	$sempro->ket = $request->notes;
	        }

	        $sempro->save();	   	    	

            return redirect()->route('dosen.transactions.konfimasi_perpanjang_ta_1')->withMessage('Anda telah berhasil mengupdate konfirmasi perpanjang TA !');
       }	       
    } 

	public function konfimasi_perpanjang_ta_2_approved(Request $request, $id)
	{

       	set_time_limit(0);
       	if( $request->status_approve_ta == 3 ){
       		$validator = Validator::make($request->all(), [
	           'notes' => 'required',
	        ]);       
       	}else{
       		$validator = Validator::make($request->all(), [

       		]);   
       	}

       	if ($validator->fails()) {
            return redirect()->route('dosen.transactions.detail_konfirmasi_kompre_mhs', $id)->withInput()->withErrors($validator);
       	}else{
			$kompre 	= MhsPerpanjangTa_2::where('id', $id)->first();

	        $kompre->updated_by				  = Auth::user()->username;
	        $kompre->id_status_agree_perpanjang = $request->status_approve_ta;	
	        if( $request->status_approve_ta == 3 ) {
	        	$kompre->ket = $request->notes;
	        }

	        $kompre->save();	   	    	

            return redirect()->route('dosen.transactions.konfimasi_perpanjang_ta_2')->withMessage('Anda telah berhasil mengupdate konfirmasi perpanjang Kompre !');
       }	       
    }     

    public function konfimasi_pembimbing_ta()
	{
		$data['dosen_pembimbing'] = Dosen_pembimbing::select('dosen_pembimbing.*', 'mhs.*')->join('mhs', 'dosen_pembimbing.nim', '=', 'mhs.nim')->where('mhs.nip_pa', '=', Auth::user()->username)->get();
		return view('dosen.transactions.konfimasi_pembimbing_ta', $data);
	}

	public function konfirmasi_perpanjang_sempro_dosen()
	{
		$data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::select('mhs_perpanjang_sempro.*', 'mhs.*', 'mhs.nama as mhs_name', 'dosen.nama as dosen_name', 'dosen.*')->join('mhs', 'mhs.nim', '=', 'mhs_perpanjang_sempro.nim')->join('dosen', 'dosen.nip', '=', 'mhs.nip_pa')->where('dosen.nip', '=', Auth::user()->username)->get();

		// return $data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::with('sempro', 'join_mhs', 'join_dosen')->get();
		return view('dosen.transactions.konfirmasi_perpanjang_sempro_dosen', $data);
	}

	public function konfirmasi_perpanjang_kompre_dosen()
	{
		$data['konfirmasi_pembimbing'] = MhsPerpanjangTa_2::select('mhs_perpanjang_ta_2.*', 'mhs.*', 'mhs.nama as mhs_name', 'dosen.nama as dosen_name', 'dosen.*')->join('mhs', 'mhs.nim', '=', 'mhs_perpanjang_ta_2.nim')->join('dosen', 'dosen.nip', '=', 'mhs.nip_pa')->where('dosen.nip', '=', Auth::user()->username)->get();

		// return $data['konfirmasi_pembimbing'] = MhsPerpanjangSempro::with('sempro', 'join_mhs', 'join_dosen')->get();
		return view('dosen.transactions.konfirmasi_perpanjang_kompre_dosen', $data);
	}

	public function store_konfirmasi_jadwal_sempro_no(Request $request, $id)
	{
		# code...
   		$validator = Validator::make($request->all(), [
           'ket' => 'required',
        ]); 

       	if ($validator->fails()) {
            return redirect()->route('dosen.transactions.konfirmasi_jadwal_sempro')->withInput()->withErrors($validator);
       	}else{
       		$find = Penguji_ta_1::where('nim', $id)->where('nip', Auth::user()->username)->first();
			$find['status_agree_penguji'] = 2;
			$find['ket'] = $request->ket;
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d H:m:s');
			$find->update();

			$find = new History_penguji_ta_1();
			$find['nim'] = $id;
			$find['nip'] = Auth::user()->username;
			$find['ket'] = $request->ket;
			$find['created_by'] = Auth::user()->username;		
			$find->save();

            return redirect()->route('dosen.transactions.konfirmasi_jadwal_sempro')->withMessage('Anda telah berhasil mengupdate konfirmasi jadwal sempro !');			
       	}        
	}

	public function store_konfirmasi_jadwal_kompre_no(Request $request, $id)
	{
		# code...
   		$validator = Validator::make($request->all(), [
           'ket' => 'required',
        ]); 

       	if ($validator->fails()) {
            return redirect()->route('dosen.transactions.konfimasi_jadwal_kompre')->withInput()->withErrors($validator);
       	}else{
       		$find = Penguji_ta_2::where('nim', $id)->where('nip', Auth::user()->username)->first();
			$find['status_agree_penguji'] = 2;
			$find['ket'] = $request->ket;
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d H:m:s');
			$find->update();

			$find = new History_penguji_ta_2();
			$find['nim'] = $id;
			$find['nip'] = Auth::user()->username;
			$find['ket'] = $request->ket;
			$find['created_by'] = Auth::user()->username;		
			$find->save();

            return redirect()->route('dosen.transactions.konfimasi_jadwal_kompre')->withMessage('Anda telah berhasil mengupdate konfirmasi jadwal kompre !');			
       	}        
	}		

	public function store_konfirmasi_jadwal_sempro_yes(Request $request, $id)
	{
		# code...
   		$find = Penguji_ta_1::where('nim', $id)->where('nip', Auth::user()->username)->first();
		$find['status_agree_penguji'] = 1;
		$find['ket'] = $request->ket;
		$find['updated_by'] = Auth::user()->username;
		$find['updated_at'] = date('Y-m-d H:m:s');
		$find->update();

		$find = new History_penguji_ta_1();
		$find['nim'] = $id;
		$find['nip'] = Auth::user()->username;
		$find['ket'] = $request->ket;
		$find['created_by'] = Auth::user()->username;		
		$find->save();

        return redirect()->route('dosen.transactions.konfirmasi_jadwal_sempro')->withMessage('Anda telah berhasil mengupdate konfirmasi jadwal sempro !');		
	}

	public function store_konfirmasi_jadwal_kompre_yes(Request $request, $id)
	{
		# code...
   		$find = Penguji_ta_2::where('nim', $id)->where('nip', Auth::user()->username)->first();
		$find['status_agree_penguji'] = 1;
		$find['ket'] = $request->ket;
		$find['updated_by'] = Auth::user()->username;
		$find['updated_at'] = date('Y-m-d H:m:s');
		$find->update();

		$find = new History_penguji_ta_2();
		$find['nim'] = $id;
		$find['nip'] = Auth::user()->username;
		$find['ket'] = $request->ket;
		$find['created_by'] = Auth::user()->username;		
		$find->save();

        return redirect()->route('dosen.transactions.konfimasi_jadwal_kompre')->withMessage('Anda telah berhasil mengupdate konfirmasi jadwal kompre !');		
	}				

	public function profile()
	{		
		$username = Auth::user()->username;
		$data['profile'] = User::with('join_dosen')->where('username', $username)->first();
		return view('dosen.general.profile', $data);
	}
    public function edit_profile(Request $request, $nip)
    {    	
        if( $request->hasFile('photo') && $request->file('photo')->isValid()) 
        {
              set_time_limit(0);
                $validator = Validator::make($request->all(), [
               'photo'    => 'required|max:10000'
            ]);

           if ($validator->fails()) {
                return redirect()->route('dosen.profile', $id)->withInput()->withErrors($validator);
           }else{                        
            
                $dosen                        = Dosen_model::where('nip', $nip)->first();
                $file                      	  = $request->file('photo');
                $fileName3                	  = uniqid() . '.'. $file->getClientOriginalExtension();
                $request->file('photo')->move("assets/images/", $fileName3);

                $dosen->photo             	   = $fileName3;                          
                $dosen->nama         		   = $request->nama;
                $dosen->alamat    	      	   = $request->alamat;                           
                $dosen->update();

                $update_user                        = User::where('username', $nip)->first();
                $update_user->name 					= $request->nama;
                $update_user->update();


                return redirect()->route('dosen.profile')->withInput()->withMessage('Profile success edited !');
           }
        }else{
                $dosen                     	   = Dosen_model::where('nip', $nip)->first();               
                $dosen->nama         		   = $request->nama;
                $dosen->alamat    	      	   = $request->alamat;                           
                $dosen->update();

				$update_user                        = User::where('username', $nip)->first();
                $update_user->name 					= $request->nama;
                $update_user->update();                

                return redirect()->route('dosen.profile')->withInput()->withMessage('Profile success edited !');
        }
    }


	public function edit_pass()
	{
		# code...
		$data['profile'] = Auth::user()->username;
		return view('dosen.transactions.edit_pass', $data);
	}

	public function store_update_pass(Request $request, $nip)
	{
		$validator = Validator::make($request->all(), [
				'password' => 'required|min:6',              
            ]);
	
		if ($validator->fails()) {
            	return redirect()->route('dosen.edit_pass')->withInput()->withMessage('Your password less from 6 characters !');              
        }else{
        	if ($request->password != $request->confirm_password) {
            	return redirect()->route('dosen.edit_pass')->withInput()->withMessage('Your password doesn\'t match !');
			}else{
				$update_pass = User::where('username', $nip)->first();
				$update_pass->password = bcrypt($request->password);
				$update_pass->update();

				return redirect()->route('dosen.edit_pass')->withInput()->withMessage('Your password success updated !');
			}
        }
	}

}
