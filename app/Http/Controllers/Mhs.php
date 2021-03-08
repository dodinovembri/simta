<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Mhs_model;
use App\Models\Ta_1_model;
use App\Models\Ta_2;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Mhs_kkt_file;
use App\Models\Mhs_kkt_file_history;
use App\Models\Mhs_sk_ta;
use App\Models\Sk_ta_history;
use App\Models\Notifications_model;
use App\Models\Penguji_ta_1;
use App\Models\Penguji_ta_2;

class Mhs extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$data['status_kkt_file'] = mhs_kkt_file::where('nim', Auth::user()->username)->first();
		$data['mhs']			 = Mhs_model::where('nim', Auth::user()->username)->first();

		return view('mhs.general.dashboard', $data);
	}
	
	public function profile()
	{		
		$username = Auth::user()->username;
		$data['profile'] = User::with('join_mhs')->where('username', $username)->first();
		return view('mhs.general.profile', $data);
	}

	public function view_upload_kkt_file()
	{	
		$find = Notifications_model::where('identity', Auth::user()->username)->where('code', 'm_kkt')->where('is_read', 0)->first();
		$data['kkt_file'] = Mhs_kkt_file::where('nim', Auth::user()->username)->first();
		$data['mhs']	  = Mhs_model::where('nim', Auth::user()->username)->first();

		if (isset($find)) {
			$find['is_read'] = 1;
			$find->update();
		}	

		return view('mhs.transactions.view_upload_kkt_file', $data);
	}	

	public function store_kkt_file(Request $request)
	{
       	set_time_limit(0);
        
        $validator = Validator::make($request->all(), [
           'kp_file' => 'mimes:jpeg,jpg,png,gif|required|max:2000',
           'krs_file' => 'mimes:jpeg,jpg,png,gif|required|max:2000',
           'transkrip_file' => 'mimes:jpeg,jpg,png,gif|required|max:2000',
           'jumlah_sks_tempuh' => 'numeric|min:1',
           'jumlah_sks_transkrip' => 'numeric|min:1'
       ]);
        
       if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
       }else{
       		$check_data						= Mhs_kkt_file::where('nim', Auth::user()->username)->first();

       		if(!empty($check_data)){

	       		$check_data->nim  				= Auth::user()->username;

	       		// Store KP File
	       		//
		        $file 							= $request->file('kp_file');
		        $fileName 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('kp_file')->move("assets/images/", $fileName);
		        
		        $check_data->kp_file  			= $fileName;

		        // Store KRS File
		        //
		        $file 							= $request->file('krs_file');
		        $fileName2 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('krs_file')->move("assets/images/", $fileName2);
		        
		        $check_data->krs_file  			= $fileName2;

		        // Store Transkrip File
		        //
		        $file 							= $request->file('transkrip_file');
		        $fileName3 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('transkrip_file')->move("assets/images/", $fileName3);
		        
		        $check_data->transkrip_file  		= $fileName3;
		        $check_data->jumlah_sks_transkrip = $request->jumlah_sks_transkrip;
		        $check_data->jumlah_sks_tempuh 	= $request->jumlah_sks_tempuh;
		        $check_data->total_sks 			= $request->jumlah_sks_transkrip + $request->jumlah_sks_tempuh;
		        $check_data->updated_by			= Auth::user()->username;
		        $check_data->save();


		        $mhs 							= Mhs_model::where('nim', Auth::user()->username)->first();
		        $mhs->status_kkt_file			= 1;
		        $mhs->update();

       		}else{

	       		$kkt_data 						= new Mhs_kkt_file;
	       		$kkt_data->nim  				= Auth::user()->username;

	       		// Store KP File
	       		//
		        $file 							= $request->file('kp_file');
		        $fileName 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('kp_file')->move("assets/images/", $fileName);
		        
		        $kkt_data->kp_file  			= $fileName;

		        // Store KRS File
		        //
		        $file 							= $request->file('krs_file');
		        $fileName2 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('krs_file')->move("assets/images/", $fileName2);
		        
		        $kkt_data->krs_file  			= $fileName2;

		        // Store Transkrip File
		        //
		        $file 							= $request->file('transkrip_file');
		        $fileName3 						= uniqid() . '.'. $file->getClientOriginalExtension();

		        $request->file('transkrip_file')->move("assets/images/", $fileName3);
		        
		        $kkt_data->transkrip_file  		= $fileName3;
		        $kkt_data->jumlah_sks_transkrip = $request->jumlah_sks_transkrip;
		        $kkt_data->jumlah_sks_tempuh 	= $request->jumlah_sks_tempuh;
		        $kkt_data->total_sks 			= $request->jumlah_sks_transkrip + $request->jumlah_sks_tempuh;
		        $kkt_data->created_by			= Auth::user()->username;
		        $kkt_data->save();

		        $mhs 							= Mhs_model::where('nim', Auth::user()->username)->first();
		        $mhs->status_kkt_file			= 1;
		        $mhs->update();


       		}

	        // Store History Data
	        //
       		$kkt_data2 						= new Mhs_kkt_file_history;
       		$kkt_data2->nim  				= Auth::user()->username;
	        $kkt_data2->kp_file  			= $fileName;
	        $kkt_data2->krs_file  			= $fileName2;
	        $kkt_data2->transkrip_file  	= $fileName3;
	        $kkt_data2->jumlah_sks_transkrip= $request->jumlah_sks_transkrip;
	        $kkt_data2->jumlah_sks_tempuh 	= $request->jumlah_sks_tempuh;
	        $kkt_data2->total_sks 			= $request->jumlah_sks_transkrip + $request->jumlah_sks_tempuh;
	        $kkt_data2->created_by			= Auth::user()->username;
	        $kkt_data2->save();

	        $code = 'admin_kkt';
	        $identity = 'admin';
	        $notif = Notifications::masuk($code, $identity);

            return redirect()->back()->withInput()->withMessage('Anda telah berhasil menambahkan KKT File !');

       }
	}

	public function mhs_aktif()
	{
		$data['mhs_aktif'] = Mhs_model::where('status_aktif', 1)->get();
		return view('mhs/mhs_aktif', $data);
	}

	public function mhs_memenuhi_syarat()
	{
		$data['mhs_memenuhi_syarat'] = Mhs_model::where('status_kkt_file', 2)->get();
		return view('mhs/mhs_memenuhi_syarat', $data);
	}

	public function mhs_tidak_memenuhi_syarat()
	{
		$data['mhs_tidak_memenuhi_syarat'] = Mhs_model::where('status_kkt_file', 3)->get();
		return view('mhs/mhs_tidak_memenuhi_syarat', $data);
	}

	public function upload_data_mhs()
	{
		$data['upload_data_mhs'] = Mhs_model::where('status_kkt_file', 0)->get();
		return view('mhs/upload_data_mhs', $data);
	}	

	public function input_topik_ta()
	{
		return view('mhs/input_topik_ta');
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

	public function status_kompre()
	{
		# code...
		return view('mhs.transactions.status_kompre');
	}

	public function jadwal_kompre()
	{
		$data['ta']  = Ta_2::where('nim', Auth::user()->username)->where('id_status_ta_2', 7)->first();
		$data['cek'] = Penguji_ta_2::where('nim', Auth::user()->username)->where('status_agree_penguji', 0)->count();
		$data['penguji']  = Penguji_ta_2::select('ta_2.*', 'penguji_ta_2.*', 'dosen.nama as nama_dosen')->join('ta_2', 'penguji_ta_2.nim', '=', 'ta_2.nim')->join('dosen', 'penguji_ta_2.nip', '=', 'dosen.nip')->where('ta_2.nim', '=', Auth::user()->username)->where('ta_2.id_status_ta_2', '=', 7)->get();

		$data['ta_all']  = Ta_2::where('id_status_ta_2', 7)->get();

		return view('mhs.transactions.jadwal_kompre_mhs', $data);
	}	

	function jadwal_sempro()
	{
		$data['ta']  = Ta_1_model::where('nim', Auth::user()->username)->where('id_status_ta_1', 7)->first();
		
		$data['cek'] = Penguji_ta_1::where('nim', Auth::user()->username)->where('status_agree_penguji', 0)->count();

		$data['penguji']  = Penguji_ta_1::select('ta_1.*', 'penguji_ta_1.*', 'dosen.nama as nama_dosen')->join('ta_1', 'penguji_ta_1.nim', '=', 'ta_1.nim')->join('dosen', 'penguji_ta_1.nip', '=', 'dosen.nip')->where('ta_1.nim', '=', Auth::user()->username)->where('ta_1.id_status_ta_1', '=', 7)->get();

		$data['ta_all']  = Ta_1_model::where('id_status_ta_1', 7)->get();
		return view('mhs.transactions.jadwal_sempro_mhs', $data);
	}

	public function form_pengajuan_sk_sempro()
	{
		# code...
		$data['cek'] = Mhs_sk_ta::where('nim', Auth::user()->username)->where('id_sk_ta_type', 0)->first();
		return view('mhs.transactions.form_pengajuan_sk_sempro', $data);
	}

	public function form_pengajuan_sk_kompre()
	{
		# code...
		$data['cek'] = Mhs_sk_ta::where('nim', Auth::user()->username)->where('id_sk_ta_type', 1)->first();		
		return view('mhs.transactions.form_pengajuan_sk_kompre', $data);
	}	

	public function store_mhs_perpanjang_sk_sempro(Request $request)
	{		

       	set_time_limit(0);
        	$validator = Validator::make($request->all(), [
           		'sk_sempro' 	=> 'required|max:10000'
			]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_pengajuan_sk_sempro')->withInput()->withErrors($validator);
       }else{
       		$mhs_sk_ta 	= Mhs_sk_ta::where('nim', Auth::user()->username)->first();
			// $topik_ta = Mhs_topik_ta::where('nim',Auth::user()->username)->first();
			
			if (empty($mhs_sk_ta)) {
   			$mhs_sk_ta 	= new Mhs_sk_ta();

	        $file 				= $request->file('sk_sempro');
	        $fileName3 			= uniqid() . '.'. $file->getClientOriginalExtension();
	        $request->file('sk_sempro')->move("assets/images/", $fileName3);

	        $mhs_sk_ta->nim 					= Auth::user()->username;
	        $mhs_sk_ta->tanggal_sk_ta 			= date('Y-m-d');
		    $mhs_sk_ta->sk_ta_file 				= $fileName3;
	        $mhs_sk_ta->id_sk_ta_type 			= 0;
	        $mhs_sk_ta->status 					= 0; 		        
	        $mhs_sk_ta->created_by				= Auth::user()->username;
			$mhs_sk_ta->save();
			
			} else {
			
	        $file 				= $request->file('sk_sempro');
	        $fileName3 			= uniqid() . '.'. $file->getClientOriginalExtension();
	        $request->file('sk_sempro')->move("assets/images/", $fileName3);
			$mhs_sk_ta->sk_ta_file 	= $fileName3;
	        $mhs_sk_ta->updated_by				= Auth::user()->username;
			$mhs_sk_ta->update();

			}

			$mhs_sk_ta_history 	= new Sk_ta_history();
	        $mhs_sk_ta_history->nim 					= Auth::user()->username;
	        $mhs_sk_ta_history->tanggal_sk_ta 			= date('Y-m-d');
		    $mhs_sk_ta_history->sk_ta_file 				= $fileName3;
	        $mhs_sk_ta_history->id_sk_ta_type 			= 0;
	        $mhs_sk_ta_history->status 					= 0; 		        
	        $mhs_sk_ta_history->created_by				= Auth::user()->username;
	        $mhs_sk_ta_history->save();

            return redirect()->route('mhs.transactions.form_pengajuan_sk_sempro')->withInput()->withMessage('Anda telah berhasil melakukan Pengajuan SK Sempro !');
       }
	}	

	public function store_mhs_perpanjang_sk_kompre(Request $request)
	{		

       	set_time_limit(0);
        	$validator = Validator::make($request->all(), [
           		'sk_kompre' 	=> 'required|max:10000'
			]);

       if ($validator->fails()) {
            return redirect()->route('mhs.transactions.form_pengajuan_sk_kompre')->withInput()->withErrors($validator);
       }else{
       		$mhs_sk_ta 	= mhs_sk_ta::where('nim', Auth::user()->username)->where('id_sk_ta_type', 1)->first();
			// $topik_ta = Mhs_topik_ta::where('nim',Auth::user()->username)->first();
			
			if (empty($mhs_sk_ta)) {
   			$mhs_sk_ta 	= new mhs_sk_ta();

	        $file 				= $request->file('sk_kompre');
	        $fileName3 			= uniqid() . '.'. $file->getClientOriginalExtension();
	        $request->file('sk_kompre')->move("assets/images/", $fileName3);

	        $mhs_sk_ta->nim 					= Auth::user()->username;
	        $mhs_sk_ta->tanggal_sk_ta 			= date('Y-m-d');
		    $mhs_sk_ta->sk_ta_file 				= $fileName3;
	        $mhs_sk_ta->id_sk_ta_type 			= 1;
	        $mhs_sk_ta->status 					= 0; 		        
	        $mhs_sk_ta->created_by				= Auth::user()->username;
			$mhs_sk_ta->save();
			
			} else {
			
	        $file 								= $request->file('sk_kompre');
	        $fileName3 							= uniqid() . '.'. $file->getClientOriginalExtension();
	        $request->file('sk_kompre')->move("assets/images/", $fileName3);
			$mhs_sk_ta->sk_ta_file 				= $fileName3;
	        $mhs_sk_ta->updated_by				= Auth::user()->username;
			$mhs_sk_ta->update();

			}

			$mhs_sk_ta_history 	= new Sk_ta_history();
	        $mhs_sk_ta_history->nim 					= Auth::user()->username;
	        $mhs_sk_ta_history->tanggal_sk_ta 			= date('Y-m-d');
		    $mhs_sk_ta_history->sk_ta_file 				= $fileName3;
	        $mhs_sk_ta_history->id_sk_ta_type 			= 1;
	        $mhs_sk_ta_history->status 					= 0; 		        
	        $mhs_sk_ta_history->created_by				= Auth::user()->username;
	        $mhs_sk_ta_history->save();

            return redirect()->route('mhs.transactions.form_pengajuan_sk_kompre')->withInput()->withMessage('Anda telah berhasil melakukan Pengajuan SK Kompre !');
       }
	}	

    public function edit_profile(Request $request, $nim)
    {    	
        if( $request->hasFile('photo') && $request->file('photo')->isValid()) 
        {
              set_time_limit(0);
                $validator = Validator::make($request->all(), [
               'photo'    => 'required|max:10000'
            ]);

           if ($validator->fails()) {
                return redirect()->route('mhs.profile', $id)->withInput()->withErrors($validator);
           }else{                        
            
                $mhs                        = Mhs_model::where('nim', $nim)->first();
                $file                       = $request->file('photo');
                $fileName3                  = uniqid() . '.'. $file->getClientOriginalExtension();
                $request->file('photo')->move("assets/images/", $fileName3);

                $mhs->photo                = $fileName3;                          
                $mhs->nama         		   = $request->nama;
                $mhs->alamat    	       = $request->alamat;                           
                $mhs->update();

                return redirect()->route('mhs.profile')->withInput()->withMessage('Profile success edited !');
           }
        }else{
                $mhs                       = Mhs_model::where('nim', $nim)->first();               
                $mhs->nama         		   = $request->nama;
                $mhs->alamat    	       = $request->alamat;                           
                $mhs->update();

                return redirect()->route('mhs.profile')->withInput()->withMessage('Profile success edited !');
        }
    }

	public function edit_pass()
	{
		# code...
		$data['profile'] = Auth::user()->username;
		return view('mhs.general.edit_pass', $data);
	}

	public function store_update_pass(Request $request, $nim)
	{
		$validator = Validator::make($request->all(), [
				'password' => 'required|min:6',              
            ]);
	
		if ($validator->fails()) {
            	return redirect()->route('mhs.edit_pass')->withInput()->withMessage('Your password less from 6 characters !');              
        }else{
        	if ($request->password != $request->confirm_password) {
            	return redirect()->route('mhs.edit_pass')->withInput()->withMessage('Your password doesn\'t match !');
			}else{
				$update_pass = User::where('username', $nim)->first();
				$update_pass->password = bcrypt($request->password);
				$update_pass->update();

				return redirect()->route('mhs.edit_pass')->withInput()->withMessage('Your password success updated !');
			}
        }
	}    
}
