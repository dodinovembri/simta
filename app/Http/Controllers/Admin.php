<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Mhs_model;
use App\Models\Mhs_kkt_file;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Dosen_model;
use App\Models\Ta_1_model;
use App\Models\Ta_1_history;
use App\Models\Ta_2_history;
use App\Models\Penguji_ta_1;
use App\Models\Penguji_ta_2;
use App\Models\Mhs_topik_ta;
use App\Models\bidang_ilmu	;
use App\Models\Dosen_pembimbing;
use App\Models\Ceklis_syarat_ta_1;
use App\Models\Ceklis_syarat_ta_2;
use App\Models\Ta_2 as Ta_2_model;
use Auth;
use Excel;
use DB;
use Illuminate\Support\Facades\Validator;
use App\User;

use Illuminate\Http\Request;

class Admin extends Controller {

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
		$data['mhs_daftar_kompre'] = Ta_2_model::where('id_status_ta_2', 1)->count();
		$data['mhs_masih_proses'] = Ta_2_model::where('id_status_ta_2', 'NOT LIKE', 5)->count();
		$data['mhs_selesai'] = Ta_2_model::where('id_status_ta_2', 5)->count();		
		if ($data['mhs_selesai'] == 0) {
			$data['mhs_selesai'] = 1;
		}	
		$jumlah_mhs = Mhs_model::count();
		if ($jumlah_mhs == 0) {
			$jumlah_mhs = 1;
		}
		$persen = $data['mhs_selesai']/$jumlah_mhs * 100;
		$data['persen'] = $persen;

		return view('admin.general.dashboard', $data);
	}

	public function profile()
	{		
		$data['profile'] = User::where('username', Auth::user()->username)->first();
		return view('admin.general.profile', $data);
	}

	public function verifikasi_data_mhs()
	{
		$data['verifikasi_data_mhs'] = Mhs_model::with('nip_dosen')->join('mhs_kkt_file', 'mhs.nim', '=','mhs_kkt_file.nim')->where('mhs.status_kkt_file', 1)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('admin.mhs.verifikasi_data_mhs', $data);
	}

	public function verifikasi_data_mhs_detail($nim)
	{
		$data['mhs'] = Mhs_kkt_file::where('nim', $nim)->first();
		return view('admin.mhs.verifikasi_data_mhs_detail', $data);
	}	

	public function mhs()
	{
		$data['mhs'] 		= Mhs_model::with('nip_dosen')->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();
		return view('admin.mhs.mhs_list', $data);		
	}	

	public function add_new_mhs()
	{
		$data['angkatan'] = Angkatan::get();
		$data['jurusan'] = Jurusan::get();
		$data['dosen'] = Dosen_model::get();

		return view('admin.mhs.add_new_mhs', $data);
	}	

	public function create_user(Request $request)
	{	
		// return $request->all();	
		$input = new Mhs_model();
		$input['nim'] = $request->input('nim');		             
		$input['nama'] = $request->input('full_name');		             
		$input['alamat'] = $request->input('address'); //ini belum diinsert ke table address
		$input['id_angkatan'] = $request->input('angkatan');		             
		$input['id_jurusan'] = $request->input('jurusan');		             
		$input['created_by'] = Auth::user()->username;		
		$input->save(); 		   

        return redirect('admin/mhs')->with('status', 'User Success Added!');
	}	

	public function mhs_aktif()
	{
		$data['mhs_aktif'] 		= Mhs_model::with('nip_dosen')->where('status_aktif', 1)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('admin.mhs.mhs_aktif', $data);
	}

	public function mhs_memenuhi_syarat()
	{
		$data['mhs_memenuhi_syarat'] = Mhs_model::with('nip_dosen')->where('status_kkt_file', 2)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('admin.mhs.mhs_memenuhi_syarat', $data);
	}

	public function mhs_tidak_memenuhi_syarat()
	{
		$data['mhs_tidak_memenuhi_syarat'] = Mhs_model::with('nip_dosen')->where('status_kkt_file', 3)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();

		return view('admin.mhs.mhs_tidak_memenuhi_syarat', $data);
	}	

	public function upload_data_mhs()
	{
		$data['upload_data_mhs'] = Mhs_model::where('status_kkt_file', 0)->get();
		return view('mhs/upload_data_mhs', $data);
	}	

	public function verifikasi_sukses()
	{
		$data['verifikasi_sukses'] 		= Mhs_model::with('nip_dosen')->where('status_kkt_file', 2)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();
		
		return view('admin.mhs.verifikasi_sukses', $data);
	}		

	public function verifikasi_gagal()
	{
		$data['verifikasi_gagal'] 		= Mhs_model::with('nip_dosen')->where('status_kkt_file', 3)->get();
		$data['angkatans'] 	= Angkatan::all();
		$data['jurusans'] 	= Jurusan::all();
		
		return view('admin.mhs.verifikasi_gagal', $data);
	}	

	public function dosen()
	{
		$data['dosen'] = Dosen_model::with('bidang_ilmu')->get();
		return view('admin.general.dosen', $data);
	}

	public function topik_ta_mhs()
	{
		$data['topik_ta_mhs'] = Mhs_topik_ta::with('topik_ta')->get();
		return view('admin.dosen.topik_ta_mhs', $data);
	}			

	public function downloadTemplate(Request $request)
	{
		$nama_file = 'mhs_template_'.date('Y-m-d_H-i-s').'.xlsx';
		Excel::create($nama_file, function($excel) use($request) {

		    $excel->sheet('Template', function($sheet) use($request) {
				$sheet->setColumnFormat(array(
				    'A' => '@',
				    'B' => '@',
				    'E' => '@',
				));

		    	$angkatan = Angkatan::find($request->angkatan)->angkatan;
		    	$jurusan = Jurusan::find($request->jurusan)->jurusan;
		        $sheet->loadView('exports.mhs', array('angkatan' => $angkatan, 'jurusan' => $jurusan));

		    });

		})->download('xls');
	}

	public function ImportMhs(Request $request)
	{

	    $path = $request->file('file')->getRealPath();

    	$data = Excel::load($path)->get();

    	if($data->count() > 0)
    	{
		    $insert_data = [];
      		foreach($data->toArray() as $key => $value)
      		{
      			$cek_dosen 			= Dosen_model::where('nip', $value['nip_pa'])->first();
      			if (!empty($cek_dosen)) {
	        		$check_mhs          = Dosen_pembimbing::where('nim', $value['nim'])->first();
	        		$check_mhs2          = Mhs_model::where('nim', $value['nim'])->first();
			        $exists_mhs         = [];
			        $not_found_angkatan = [];
			        $not_found_jurusan  = [];
			        $imported_mhs       = [];
			        if(empty($check_mhs) && empty($check_mhs2)){
			            $angkatan = Angkatan::where('angkatan', $value['angkatan'])->first();
			            $jurusan = Jurusan::where('jurusan', $value['jurusan'])->first();
			            if(empty($angkatan)){
			                array_push($not_found_angkatan, $value['nim']);

			            }else if(empty($jurusan)){
			                array_push($not_found_jurusan, $value['nim']);
			            }else{

							$insert_data[] = array(
			                    'nim'   		=> $value['nim'],
			                    'nip_pa'   		=> $value['nip_pa'],
			                    'nama' 			=> $value['nama'],
			                    'alamat' 		=> $value['alamat'], 
			                    'id_angkatan' 	=> $angkatan->id, 
			                    'id_jurusan' 	=> $jurusan->id, 
			                    'created_by'	=> Auth::user()->username,
			                    'created_at'	=> date('Y-m-d H:i:s')
							);

			                array_push($imported_mhs, $value['nim']);
			            }
			        }else{
			            array_push($exists_mhs, $value['nim']);
			        }      				
      			}else{
	            	return redirect('/admin/master/mhs')->withMessage('Dosen with NIP '.$value['nip_pa']. 'not found in database dosen !');			      	
      			}
      		}      		

			if(!empty($insert_data))
			{
				DB::table('mhs')->insert($insert_data);
			}


            return redirect('/admin/master/mhs')->withMessage('Mahasiswa success added !');			
        	// return redirect()->back()->withMessage(array('success' => $imported_mhs, 'exists' => $exists_mhs, 'not_found_angkatan' => $not_found_angkatan, 'not_found_jurusan' => $not_found_jurusan));
		}
	}	


	public function store_verifikasi_data_mhs_detail($nim, Request $request)
	{

        $validator = Validator::make($request->all(), [
           'notes' => 'required'
       ]);
        
       if ($validator->fails()) {
            	return redirect('/admin/transactions/verifikasi_data_mhs')->withMessage('Anda telah berhasil memverifikasi KKT File !');

       }else{
       		if($request->kp_file && $request->krs_file && $request->transkrip_file && $request->notes){
       			$mhs 						= Mhs_model::where('nim', $nim)->first();
       			$mhs->status_kkt_file 		= 2;
       			$mhs->updated_by 			= Auth::user()->username;
       			$mhs->updated_at 			= date('Y-m-d H:i:s');
       			$mhs->save();

       			$mhs_kkt_file 				= Mhs_kkt_file::where('nim', $nim)->first();
       			$mhs_kkt_file->ket 			= $request->notes;
       			$mhs_kkt_file->updated_by 	= Auth::user()->username;
       			$mhs_kkt_file->updated_at 	= date('Y-m-d H:i:s');
       			$mhs->save();

       		}else if($request->notes && (!$request->kp_file || !$request->krs_file || !$request->transkrip_file )){

       			$mhs 						= Mhs_model::where('nim', $nim)->first();
       			$mhs->status_kkt_file 		= 3;
       			$mhs->updated_by 			= Auth::user()->username;
       			$mhs->updated_at 			= date('Y-m-d H:i:s');
       			$mhs->save();

       			$mhs_kkt_file 				= Mhs_kkt_file::where('nim', $nim)->first();
       			$mhs_kkt_file->ket 			= $request->notes;
       			$mhs_kkt_file->updated_by 	= Auth::user()->username;
       			$mhs_kkt_file->updated_at 	= date('Y-m-d H:i:s');
       			$mhs_kkt_file->save();

       		}

       		$code = 'm_kkt';
       		$identity = $nim;
	        $notif = Notifications::masuk($code, $identity);

            return redirect('/admin/transactions/verifikasi_data_mhs')->withMessage('Anda telah berhasil memverifikasi KKT File !');
       }        
	}

	public function syarat_ta_1()
	{
		# code...
		$data['syarat_ta_1'] = Ceklis_syarat_ta_1::all();
		return view('admin.general.syarat_ta_1', $data);
	}	

	public function syarat_ta_2()
	{
		# code...
		$data['syarat_ta_2'] = Ceklis_syarat_ta_2::all();
		return view('admin.general.syarat_ta_2', $data);
	}	

	public function jadwal_sempro()
	{
		# code...			
		$data['jadwal_sempro'] = Ta_1_model::with('join_mhs')->where('id_status_ta_1', 4)->orWhere('id_status_ta_1', 7)->get();
		return view('admin.sempro.jadwal_sempro', $data);
	}

	public function jadwal_sempro_mhs($id)
	{
		# code...		
		$data['id'] = $id;
		$data['set_penguji'] = Penguji_ta_1::with('dosen')->where('nim', $id)->get();
		$data['pembimbing'] = Dosen_pembimbing::with('join_dosen')->where('nim', $id)->get();
		return view('admin.sempro.jadwal_sempro_mhs', $data);
	}	

	public function jadwal_kompre_mhs($id)
	{
		# code...		
		$data['id'] = $id;
		$data['set_penguji'] = Penguji_ta_2::with('dosen')->where('nim', $id)->get();
		$data['pembimbing'] = Dosen_pembimbing::with('join_dosen')->where('nim', $id)->get();
		return view('admin.kompre.jadwal_kompre_mhs', $data);
	}	

	public function jadwal_kompre()
	{
		# code...
		$data['jadwal_kompre'] = Ta_2_model::with('join_mhs')->where('id_status_ta_2', 4)->orWhere('id_status_ta_2', 7)->get();
		// $data['dosen'] = Dosen_model::all();
		return view('admin.kompre.jadwal_kompre', $data);
	}	

	public function status_sempro()
	{
		# code...
		$data['ta_1'] = Ta_1_model::where('id_status_ta_1', 7)->get();
		return view('admin.sempro.status_sempro', $data);
	}	

	public function status_kompre()
	{
		# code...
		$data['ta_2'] = Ta_2_model::where('id_status_ta_2', 7)->get();
		return view('admin.kompre.status_kompre', $data);
	}				

	
	public function update_status_sempro(Request $request, $id)
	{	
		$validator = Validator::make($request->all(), [
	           'status' => 'required',
	    ]);   

       	if ($validator->fails()) {
            return redirect()->route('admin.transactions.status_sempro')->withInput()->withErrors($validator);
       	}else{

			$sempro 				= Ta_1_model::where('id', $id)->first();		
			$sempro->id_status_ta_1 = $request->status;
			
			$sempro->updated_by 	= Auth::user()->username;
			$sempro->save();

            return redirect()->route('admin.transactions.status_sempro')->withMessage('Berhasil mengupdate Persetujuan Sempro !');
			

		}	

	}	


	public function store_jadwal_sempro(Request $request)
	{
		$tanggal = new \Carbon\Carbon($request->tanggal);
		$tgl = date_format($tanggal, 'Y-m-d');

		$nim_penguji = Penguji_ta_1::where('nim', $request->nim)->get();
		$check = [];
		foreach ($nim_penguji as $key => $value) {
			$check[] = Penguji_ta_1::select('dosen.nama')->join('ta_1', 'penguji_ta_1.nim', '=', 'ta_1.nim')->where('ta_1.tanggal', '=', $tgl)->join('dosen', 'penguji_ta_1.nip', '=', 'dosen.nip')->where('ta_1.jadwal', '=', $request->jadwal)->where('penguji_ta_1.nip', '=', $value->nip)->get();			

		}	
		
		// return count($check[0]);
		if (count($check[0]) > 0) {
			return redirect()->route('admin.transactions.jadwal_sempro_mhs', $request->nim)->withInput()->withMessage("Dosen not available, Please try with another time ! $check[0]");
		}else{
			$update = Ta_1_model::where('nim', $request->nim)->first();
			$update['tanggal'] = $tgl;
			$update['jadwal'] = $request->jadwal;
			$update['id_status_ta_1'] = 7;
			$update['updated_at'] = date('Y-m-d h:m:s');	
			$update->update();

			$insert = new Ta_1_history();
			$insert['nim'] = $request->nim;
			$insert['tanggal'] = $request->tanggal;
			$insert['jadwal'] = $request->jadwal;
			$insert['id_status_ta_1'] = 7;
			$insert['created_by'] = Auth::user()->username;
			$insert->save();
		}


		// $data['jadwal_sempro'] = Ta_1_model::where('id_status_ta_1', 2)->get();
        return redirect()->route('admin.transactions.jadwal_sempro')->withMessage('Berhasil mengupdate jadwal sempro mahasiswa !');
	}

	public function store_jadwal_kompre(Request $request)
	{
		$tanggal = new \Carbon\Carbon($request->tanggal);
		$tgl = date_format($tanggal, 'Y-m-d');

		$nim_penguji = Penguji_ta_2::where('nim', $request->nim)->get();
		$check = [];
		foreach ($nim_penguji as $key => $value) {
			$check[] = Penguji_ta_2::select('dosen.nama')->join('ta_2', 'penguji_ta_2.nim', '=', 'ta_2.nim')->where('ta_2.tanggal', '=', $tgl)->join('dosen', 'penguji_ta_2.nip', '=', 'dosen.nip')->where('ta_2.jadwal', '=', $request->jadwal)->where('penguji_ta_2.nip', '=', $value->nip)->get();			

		}	
		
		// return count($check[0]);
		if (count($check[0]) > 0) {
			return redirect()->route('admin.transactions.jadwal_kompre_mhs', $request->nim)->withInput()->withMessage("Dosen not available, Please try with another time ! $check[0]");
		}else{
			$update = Ta_2_model::where('nim', $request->nim)->first();
			$update['tanggal'] = $tgl;
			$update['jadwal'] = $request->jadwal;
			$update['id_status_ta_2'] = 7;
			$update['updated_at'] = date('Y-m-d h:m:s');	
			$update->update();

			$insert = new Ta_2_history();
			$insert['nim'] = $request->nim;
			$insert['tanggal'] = $request->tanggal;
			$insert['jadwal'] = $request->jadwal;
			$insert['id_status_ta_2'] = 7;
			$insert['created_by'] = Auth::user()->username;
			$insert->save();
		}


		// $data['jadwal_sempro'] = Ta_1_model::where('id_status_ta_1', 2)->get();
        return redirect()->route('admin.transactions.jadwal_kompre')->withMessage('Berhasil mengupdate jadwal kompre mahasiswa !');
	}		

	public function add_new_dosen()
	{
		# code...
		$data['bidang_ilmu'] = Bidang_ilmu::all();
		return view('admin.transactions.dosen.add_new_dosen', $data);
	}	

	public function store_new_dosen(Request $request)
	{
		# code...
   		$check = Dosen_model::where('nip', $request->nip)->first();
		if ($check) {
			# code...
			return redirect()->route('admin.transactions.add_new_dosen')->withInput()->withMessage('Dosen already exist, Please try with another Dosen !');
		}else{
			$insert = new Dosen_model();
			$insert['nip'] = $request->nip;
			$insert['nama'] = $request->full_name;
			$insert['alamat'] = $request->address;
			$insert['id_bidang_ilmu'] = $request->bidang_ilmu;
			$insert['created_by'] = Auth::user()->username;
			$insert->save();

			return redirect()->route('admin.master.dosen')->withInput()->withMessage('Dosen success added !');
		}
       	
	}

	public function delete_dosen($id)
	{
		# code...
		$dosen = Dosen_model::find($id);
		$dosen->delete();

		$data['dosen'] = Dosen_model::with('bidang_ilmu')->get();	
		return redirect(route('admin.master.dosen', $data))->with('status', 'Dosen Success Deleted!');		
	}

	public function edit_dosen($id)
	{
		# code...
		$data['dosen'] = Dosen_model::with('bidang_ilmu')->find($id);
		$data['bidang_ilmu'] = Bidang_ilmu::all();		
		return view('admin.transactions.dosen.edit_dosen', $data);
	}

	public function store_edit_new_dosen($id, Request $request)
	{
		# code...		
	    $find = Dosen_model::find($id);
	    if ($find['nip'] == $request->nip) {
	    	# code...						
			$find['nama'] = $request->full_name;
			$find['alamat'] = $request->address;
			$find['id_bidang_ilmu'] = $request->bidang_ilmu;
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d h:m:s');
			$find->update();   			

			return redirect(route('admin.master.dosen'))->withInput()->withMessage('Dosen success edited!');					    	
	    }else{
		    	$validator = Validator::make($request->all(), [
		        'nip' => 'required|unique:dosen',	       
	    	]);

			    if ($validator->fails()) {			    
					return redirect(route('admin.transactions.edit_dosen', $id))->withInput()->withMessage('Dosen already exist!');
		       }else{
			       	$update = Dosen_model::find($id);
					$update['nip'] = $request->nip;
					$update['nama'] = $request->full_name;
					$update['alamat'] = $request->address;
					$update['id_bidang_ilmu'] = $request->bidang_ilmu;
					$update['updated_by'] = Auth::user()->username;
					$update['updated_at'] = date('Y-m-d h:m:s');
					$update->update();   			
			    
					return redirect(route('admin.master.dosen'))->withInput()->withMessage('Dosen success edited!');			
	       	}	
	    }
	}	

	public function store_new_mhs(Request $request)
	{
		# code...		
   		$check = Mhs_model::where('nim', $request->nim)->first();
		if ($check) {
			# code...			
			return redirect(route('admin.transactions.add_new_mhs'))->withInput()->withMessage('Mhs already exist, Please try with another mhs !');	
		}else{
			$insert = new Mhs_model();
			$insert['nim'] = $request->nim;
			$insert['nip_pa'] = $request->dosen;
			$insert['nama'] = $request->full_name;
			$insert['alamat'] = $request->address;
			$insert['id_angkatan'] = $request->angkatan;
			$insert['id_jurusan'] = $request->jurusan;
			$insert['created_by'] = Auth::user()->username;
			$insert->save();

			return redirect()->route('admin.master.mhs')->withInput()->withMessage('Mhs success added !');
		}
	}

	public function edit_mhs($id)
	{
		# code...
		$data['mhs'] = Mhs_model::with('nip_dosen')->with('angkatan')->with('jurusan')->find($id);
		$data['dosen'] = Dosen_model::all();
		$data['angkatan'] = Angkatan::all();
		$data['jurusan'] = Jurusan::all();
		$data['bidang_ilmu'] = Bidang_ilmu::all();	

		return view('admin.transactions.mhs.edit_mhs', $data);
	}	

	public function store_edit_new_mhs($id, Request $request)
	{
		# code...		
	    $find = Mhs_model::find($id);
	    if ($find['nim'] == $request->nim) {
	    	# code...									
			$find['nip_pa'] = $request->dosen;
			$find['nama'] = $request->full_name;
			$find['alamat'] = $request->address;
			$find['id_angkatan'] = $request->angkatan;
			$find['id_jurusan'] = $request->jurusan;
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d h:m:s');
			$find->update();   			

			return redirect(route('admin.master.mhs'))->withInput()->withMessage('Mhs success edited!');	

	    }else{
		    	$validator = Validator::make($request->all(), [
		        'nim' => 'required|unique:mhs',	       
	    	]);

			    if ($validator->fails()) {			    
					return redirect(route('admin.transactions.edit_mhs', $id))->withInput()->withMessage('Mhs already exist!');
		       }else{
			       	$update = Mhs_model::find($id);
					$update['nim'] = $request->nim;
					$update['nip_pa'] = $request->dosen;
					$update['nama'] = $request->full_name;
					$update['alamat'] = $request->address;
					$update['id_angkatan'] = $request->angkatan;
					$update['id_jurusan'] = $request->jurusan;
					$update['updated_by'] = Auth::user()->username;
					$update['updated_at'] = date('Y-m-d h:m:s');
					$update->update();   			
			    
					return redirect(route('admin.master.mhs'))->withInput()->withMessage('Mhs success edited!');			
	       	}	
	    }
	}	

	public function delete_mhs($id)
	{
		# code...
		$dosen = Mhs_model::find($id);
		$dosen->delete();
		
		return redirect(route('admin.master.mhs'))->withInput()->withMessage('Mhs success deleted!');		
	}	

	public function add_new_syarat_sempro()
	{
		# code...
		return view('admin.transactions.syarat_ta_1.add_new_syarat_sempro');
	}	

	public function store_new_syarat_sempro(Request $request)
	{
		# code...		
		$check = Ceklis_syarat_ta_1::where('file_name', $request->syarat_sempro)->first();
		if ($check) {
			# code...
			return redirect()->route('admin.master.syarat_ta_1')->withInput()->withMessage('Syarat sempro already exist !');
		}else{
			
			$insert = new Ceklis_syarat_ta_1();
			$insert['file_name'] = $request->syarat_sempro;		
			$insert['created_by'] = Auth::user()->username;
			$insert->save();

			return redirect()->route('admin.master.syarat_ta_1')->withInput()->withMessage('Syarat sempro success added !');
		}
	}

	public function edit_syarat_ta_1($id)
	{
		# code...	
		$data['syarat_ta_1'] = Ceklis_syarat_ta_1::find($id);
		return view('admin.transactions.syarat_ta_1.edit_syarat_ta_1', $data);
	}	

	public function store_edit_syarat_sempro($id, Request $request)
	{
		# code...		
	    $find = Ceklis_syarat_ta_1::find($id);
	    if ($find['file_name'] == $request->syarat_sempro) {
	    	# code...									
			$find['file_name'] = $request->syarat_sempro;		
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d h:m:s');
			$find->update();   			

			return redirect(route('admin.master.syarat_ta_1'))->withInput()->withMessage('Syarat sempro success edited!');	

	    }else{
		    	$validator = Validator::make($request->all(), [
		        'file_name' => 'required|unique:mhs',	       
	    	]);

			    if ($validator->fails()) {			    
					return redirect(route('admin.transactions.edit_syarat_ta_1', $id))->withInput()->withMessage('Syarat sempro already exist!');
		       }else{
			       	$update = Ceklis_syarat_ta_1::find($id);
					$find['file_name'] = $request->syarat_sempro;		
					$find['updated_by'] = Auth::user()->username;
					$find['updated_at'] = date('Y-m-d h:m:s');
					$update->update();   			
			    
					return redirect(route('admin.transactions.syarat_ta_1'))->withInput()->withMessage('Syarat sempro success edited!');			
	       	}	
	    }
	}	

	public function delete_syarat_ta_1($id)
	{
		# code...
		$syarat_ta_1 = Ceklis_syarat_ta_1::find($id);
		$syarat_ta_1->delete();
		
		return redirect(route('admin.master.syarat_ta_1'))->withInput()->withMessage('Syarat sempro success deleted!');		
	}

	public function add_new_syarat_kompre()
	{
		# code...
		return view('admin.transactions.syarat_ta_2.add_new_syarat_kompre');
	}	

	public function store_new_syarat_kompre(Request $request)
	{
		# code...	
		$check = Ceklis_syarat_ta_2::where('file_name', $request->syarat_kompre)->first();
		if ($check) {
			# code...
			return redirect()->route('admin.master.syarat_ta_2')->withInput()->withMessage('Syarat kompre already exist !');
		}else{

			$insert = new Ceklis_syarat_ta_2();
			$insert['file_name'] = $request->syarat_kompre;		
			$insert['created_by'] = Auth::user()->username;
			$insert->save();

			return redirect()->route('admin.master.syarat_ta_2')->withInput()->withMessage('Syarat kompre success added !');
		}
	}

	public function edit_syarat_ta_2($id)
	{
		# code...	
		$data['syarat_ta_2'] = Ceklis_syarat_ta_2::find($id);
		return view('admin.transactions.syarat_ta_2.edit_syarat_ta_2', $data);
	}	

	public function store_edit_syarat_kompre($id, Request $request)
	{
		# code...		
	    $find = Ceklis_syarat_ta_2::find($id);
	    if ($find['file_name'] == $request->syarat_kompre) {
	    	# code...									
			$find['file_name'] = $request->syarat_kompre;		
			$find['updated_by'] = Auth::user()->username;
			$find['updated_at'] = date('Y-m-d h:m:s');
			$find->update();   			

			return redirect(route('admin.master.syarat_ta_2'))->withInput()->withMessage('Syarat kompre success edited!');	

	    }else{
		    	$validator = Validator::make($request->all(), [
		        'file_name' => 'required|unique:mhs',	       
	    	]);

			    if ($validator->fails()) {			    
					return redirect(route('admin.transactions.edit_syarat_ta_2', $id))->withInput()->withMessage('Syarat kompre already exist!');
		       }else{
			       	$update = Ceklis_syarat_ta_1::find($id);
					$find['file_name'] = $request->syarat_kompre;		
					$find['updated_by'] = Auth::user()->username;
					$find['updated_at'] = date('Y-m-d h:m:s');
					$update->update();   			
			    
					return redirect(route('admin.transactions.syarat_ta_2'))->withInput()->withMessage('Syarat kompre success edited!');			
	       	}	
	    }
	}	

	public function delete_syarat_ta_2($id)
	{
		# code...
		$syarat_ta_2 = Ceklis_syarat_ta_2::find($id);
		$syarat_ta_2->delete();
		
		return redirect(route('admin.master.syarat_ta_2'))->withInput()->withMessage('Syarat kompre success deleted!');		
	}	

	public function verifikasi_seminar()
	{
		# code...
		$data['verifikasi'] = Ta_1_model::where('id_status_ta_1', 1)->get();
		return view('admin.transactions.ta_1.index', $data);
	}		

 	public function verifikasi_seminar_detail($nim)
	{
		# code...
		$data['syarat_ta_1'] = Ceklis_syarat_ta_1::all();
		$data['mhs'] = Mhs_model::where('nim', $nim)->first();
		return view('admin.transactions.ta_1.verifikasi_seminar_detail', $data);
	}	

	public function store_syarat_ta_1_mhs(Request $request)
	{
		# code...
		$count_db = Ceklis_syarat_ta_1::count();
		$count_input = count($request->syarat_ta_1);

		if ($count_db == $count_input) {
			$update = Ta_1_model::where('nim', $request->nim)->first();
			$update['id_status_ta_1'] = 2;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d h:m:s');
			$update->update();

			$insert = new Ta_1_history();
			$insert['nim'] = $request->nim;
			$insert['id_status_ta_1'] = 2;
			$insert['created_by'] = Auth::user()->username;
			$insert['created_at'] = date('Y-m-d h:m:s');
			$insert->save();

			return redirect(route('admin.transactions.verifikasi_seminar'))->withInput()->withMessage('Syarat sempro success di verifikasi!');		

		}else{
			$update = Ta_1_model::where('nim', $request->nim)->first();
			$update['id_status_ta_1'] = 3;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d h:m:s');
			$update->update();

			$insert = new Ta_1_history();
			$insert['nim'] = $request->nim;
			$insert['id_status_ta_1'] = 3;
			$insert['created_by'] = Auth::user()->username;
			$insert['created_at'] = date('Y-m-d h:m:s');
			$insert->save();

			return redirect(route('admin.transactions.verifikasi_seminar'))->withInput()->withMessage('Syarat sempro success di update!');		

		}
	}	

	public function store_konfirmasi_sudah_sempro($nim)
	{
		# code...
		$find = Ta_1_model::where('nim', $nim)->first();
		$find['id_status_ta_1'] = 5; 
		$find['updated_by'] = Auth::user()->username;
		$find['updated_at'] = date('Y-m-d H:m:s');
		$find->update();

		return redirect(route('admin.transactions.status_sempro'))->withInput()->withMessage('Status sempro mhs berhasil di update');
	}

	public function store_konfirmasi_sudah_kompre($nim)
	{
		# code...
		$find = Ta_2_model::where('nim', $nim)->first();
		$find['id_status_ta_2'] = 5; 
		$find['updated_by'] = Auth::user()->username;
		$find['updated_at'] = date('Y-m-d H:m:s');
		$find->update();

		return redirect(route('admin.transactions.status_kompre'))->withInput()->withMessage('Status kompre mhs berhasil di update');
	}			

	public function verifikasi_kompre()
	{
		$data['verifikasi'] = Ta_2_model::where('id_status_ta_2', 1)->get();
		return view('admin.transactions.ta_2.index', $data);
	}

 	public function verifikasi_kompre_detail($nim)
	{
		# code...
		$data['syarat_ta_2'] = Ceklis_syarat_ta_2::all();
		$data['mhs'] = Mhs_model::where('nim', $nim)->first();
		return view('admin.transactions.ta_2.verifikasi_kompre_detail', $data);
	}	

	public function store_syarat_ta_2_mhs(Request $request)
	{
		# code...
		$count_db = Ceklis_syarat_ta_2::count();
		$count_input = count($request->syarat_ta_2);

		if ($count_db == $count_input) {
			$update = Ta_2_model::where('nim', $request->nim)->first();
			$update['id_status_ta_2'] = 4;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d h:m:s');
			$update->update();

			$get_pembimbing_ta = Penguji_ta_1::where('nim', $request->nim)->get();
			$check = Penguji_ta_2::where('nim', $request->nim)->get();			
			if ($check) {
				foreach ($check as $key => $value) {
					$value->delete();
				}
			}
			foreach ($get_pembimbing_ta as $key => $value) {
				# code...
				$insert = new Penguji_ta_2();
				$insert['nim'] = $request->nim;
				$insert['nip'] = $value->nip;
				$insert['created_by'] = Auth::user()->username;
				$insert->save();
			}

			$insert = new Ta_2_history();
			$insert['nim'] = $request->nim;
			$insert['id_status_ta_2'] = 4;
			$insert['created_by'] = Auth::user()->username;
			$insert['created_at'] = date('Y-m-d h:m:s');
			$insert->save();

			return redirect(route('admin.transactions.verifikasi_kompre'))->withInput()->withMessage('Syarat kompre success di verifikasi!');		

		}else{
			$update = Ta_2_model::where('nim', $request->nim)->first();
			$update['id_status_ta_2'] = 4;
			$update['updated_by'] = Auth::user()->username;
			$update['updated_at'] = date('Y-m-d h:m:s');
			$update->update();

			$get_pembimbing_ta = Penguji_ta_1::where('nim', $request->nim)->get();
			
			$check = Penguji_ta_2::where('nim', $request->nim)->get();			
			if ($check) {
				foreach ($check as $key => $value) {
					$value->delete();
				}
			}			
			foreach ($get_pembimbing_ta as $key => $value) {
				# code...
				$insert = new Penguji_ta_2();
				$insert['nim'] = $request->nim;
				$insert['nip'] = $value->nip;
				$insert['created_by'] = Auth::user()->username;
				$insert->save();
			}			

			$insert = new Ta_2_history();
			$insert['nim'] = $request->nim;
			$insert['id_status_ta_2'] = 4;
			$insert['created_by'] = Auth::user()->username;
			$insert['created_at'] = date('Y-m-d h:m:s');
			$insert->save();

			return redirect(route('admin.transactions.verifikasi_kompre'))->withInput()->withMessage('Syarat kompre success di update!');		

		}
	}	

    public function edit_profile(Request $request, $username)
    {    	
        $mhs                        = User::where('username', $username)->first();           
        $mhs->name         		   	= $request->nama;                       
        $mhs->update();

        return redirect()->route('admin.profile')->withInput()->withMessage('Profile success edited !');
    }

	public function edit_pass()
	{
		# code...
		$data['profile'] = Auth::user()->username;
		return view('admin.general.edit_pass', $data);
	}

	public function store_update_pass(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
				'password' => 'required|min:6',              
            ]);
	
		if ($validator->fails()) {
            	return redirect()->route('admin.edit_pass')->withInput()->withMessage('Your password less from 6 characters !');              
        }else{
        	if ($request->password != $request->confirm_password) {
            	return redirect()->route('admin.edit_pass')->withInput()->withMessage('Your password doesn\'t match !');
			}else{
				$update_pass = User::where('username', $id)->first();
				$update_pass->password = bcrypt($request->password);
				$update_pass->update();

				return redirect()->route('admin.edit_pass')->withInput()->withMessage('Your password success updated !');
			}
        }
	}    
}