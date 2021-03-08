<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Bidang_ilmu;
use App\Models\Jurusan;
use App\Models\Angkatan;
use App\Models\User_group;
use App\Models\User_role;
use App\Models\Topik_ta;
use App\Models\Mhs_model;
use App\Models\Dosen_model;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class System extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function add_new_user()
	{
		// $data['user'] = User::all();
		return view('admin.system.user_account_list.add_new');
	}	

	public function user_role()
	{
		$data['user_role'] = User_role::all();
		return view('user/user_role', $data);
	}

	public function profile()
	{
		// $data['profile'] = User_group::all();
		return view('user/profile');
	}		

	public function add_new_bidang_ilmu()
	{
		// $data['profile'] = User_group::all();
		return view('admin.system.bidang_ilmu.add_new');
	}

	public function add_new_jurusan()
	{
		// $data['profile'] = User_group::all();
		return view('admin.system.jurusan.add_new');
	}	

	public function add_new_topik_ta()
	{
		// $data['profile'] = User_group::all();
		return view('admin.system.topik_ta.add_new');
	}		

	public function store_new_user(Request $request)
	{	

		$input['name'] = $request->input('name');		
		$input['username'] = $request->input('username');		
        $input['password']            = bcrypt($request->input('password'));                
        $store                        = User::create($input);

        return redirect(route('admin.system.user_account_list'))->with('status', 'User Success Added!');;
	}	

	public function add_new_user_role()
	{		
		return view('user/add_new_user_role');
	}	

	public function store_user_role(Request $request)
	{
		$input = new User_role();
		$input['role'] = $request->input('user_role');		             
		$input['desc'] = $request->input('desc');		             
		$input->save();        

        return redirect('/user_role')->with('status', 'User Role Success Added!');
	}

	public function edit_view($id)
	{		
		$data['user_role'] = User_role::where('id', $id)->first();
		return view('user/edit_view_user_role', $data);
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

	public function edit_role($id, Request $request)
	{
		$edit = User_role::find($id);		
		$edit->role = $request->input('user_role');
		$edit->desc = $request->input('desc');
		$edit->update();

		return redirect('/user_role')->with('status', 'User Role Success Updated!');
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

	public function delete_role($id)
	{
		$user = User_role::find($id);
		$user->delete();

		return redirect('/user_role')->with('status', 'User Role Success Deleted!');
	}	

	public function delete_user($id)
	{
		$user = User::find($id);
		$user->delete();

		return redirect(route('admin.system.user_account_list'))->with('status', 'User Success Deleted!');
	}		

	public function topik_ta()
	{
		$data['topik_ta'] = Topik_ta::all();
		return view('admin.system.topik_ta.index', $data);
	}

	public function jurusan()
	{
		$data['jurusan'] = Jurusan::all();
		return view('admin.system.jurusan.index', $data);
	}	

	public function angkatan()
	{
		$data['angkatan'] = Angkatan::all();
		return view('admin.system.angkatan.index', $data);
	}	

	public function bidang_ilmu()
	{
		$data['bidang_ilmu'] = Bidang_ilmu::all();
		return view('admin.system.bidang_ilmu.index', $data);
	}	

	public function user_account_list()
	{
		$data['user'] = User::where('role_id', 3)->orWhere('role_id', 4)->get();
		$data['mhs'] = Mhs_model::all();
		$data['dosen'] = Dosen_model::all();
		return view('admin.system.user_account_list.index', $data);
	}

	public function add_new_angkatan()
	{
		$data['user'] = User::all();
		return view('admin.system.angkatan.add_new_angkatan', $data);
	}

	public function store_new_angkatan(Request $request)
	{
		$check = Angkatan::where('angkatan', $request->input('angkatan'))->first();

		if ($check){
        	return redirect(route('admin.system.add_new_angkatan'))->with('status', 'Angkatan already exist!');
		}else{
			$input = new Angkatan();
			$input['angkatan'] = $request->input('angkatan');			
			$input['created_by'] = Auth::user()->username;		             	
			$input->save();        
        	return redirect(route('admin.system.angkatan'))->with('status', 'Angkatan success added!');
		}		
	}

	public function store_new_bidang_ilmu(Request $request)
	{
		$check = Bidang_ilmu::where('bidang_ilmu', $request->input('bidang_ilmu'))->first();

		if ($check){
        	return redirect(route('admin.system.add_new_bidang_ilmu'))->with('status', 'Bidang ilmu already exist!');
		}else{
			$input = new Bidang_ilmu();
			$input['bidang_ilmu'] = $request->input('bidang_ilmu');			
			$input['created_by'] = Auth::user()->username;		             	
			$input->save();        
        	return redirect(route('admin.system.bidang_ilmu'))->with('status', 'Bidang ilmu success added!');
		}		
	}

	public function store_new_jurusan(Request $request)
	{
		$check = Jurusan::where('jurusan', $request->input('jurusan'))->first();

		if ($check){
        	return redirect(route('admin.system.add_new_jurusan'))->with('status', 'Jurusab already exist!');
		}else{
			$input = new Jurusan();
			$input['jurusan'] = $request->input('jurusan');			
			$input['status_aktif'] = $request->input('status_active');			
			$input['created_by'] = Auth::user()->username;		             	
			$input->save();        
        	return redirect(route('admin.system.jurusan'))->with('status', 'Jurusan success added!');
		}		
	}

	public function store_new_topik_ta(Request $request)
	{
		$check = Topik_ta::where('topik_ta', $request->input('topik_ta'))->first();

		if ($check){
        	return redirect(route('admin.system.add_new_topik_ta'))->with('status', 'Topik TA already exist!');
		}else{
			$input = new Topik_ta();
			$input['topik_ta'] = $request->input('topik_ta');			
			$input['created_by'] = Auth::user()->username;		             	
			$input->save();        
        	return redirect(route('admin.system.topik_ta'))->with('status', 'Topik TA success added!');
		}		
	}				

	public function delete_angkatan($id)
	{
		# code...
		$angkatan = Angkatan::find($id);
		$angkatan->delete();

		return redirect(route('admin.system.angkatan'))->with('status', 'Angkatan success deleted!');
	}	

	public function delete_bidang_ilmu($id)
	{
		# code...
		$bidang_ilmu = Bidang_ilmu::find($id);
		$bidang_ilmu->delete();

		return redirect(route('admin.system.bidang_ilmu'))->with('status', 'Bidang ilmu success deleted!');
	}

	public function delete_jurusan($id)
	{
		# code...
		$jurusan = Jurusan::find($id);
		$jurusan->delete();

		return redirect(route('admin.system.jurusan'))->with('status', 'Jurusan success deleted!');
	}

	public function delete_topik_ta($id)
	{
		# code...
		$topik_ta = Topik_ta::find($id);
		$topik_ta->delete();

		return redirect(route('admin.system.topik_ta'))->with('status', 'Topik TA success deleted!');
	}			

	public function edit_angkatan($id)
	{
		# code...
		$data['angkatan'] = Angkatan::find($id);
		return view('admin.system.angkatan.edit', $data);
	}

	public function edit_bidang_ilmu($id)
	{
		# code...
		$data['bidang_ilmu'] = Bidang_ilmu::find($id);
		return view('admin.system.bidang_ilmu.edit', $data);
	}

	public function edit_jurusan($id)
	{
		# code...
		$data['jurusan'] = Jurusan::find($id);
		return view('admin.system.jurusan.edit', $data);
	}

	public function edit_topik_ta($id)
	{
		# code...
		$data['topik_ta'] = Topik_ta::find($id);
		return view('admin.system.topik_ta.edit', $data);
	}			

	public function store_edit(Request $request)
	{
		# code...				
		$update = Angkatan::find($request->input('id'));

		$check = Angkatan::where('angkatan', $request->input('angkatan'))->first();

		if ($check){
        	return redirect(route('admin.system.angkatan.edit', $request->input('id')))->with('status', 'Angkatan already exist!');
		}
		else{			
			$update['angkatan'] = $request->input('angkatan');			
			$update['updated_by'] = Auth::user()->username;		             	
			$update['updated_at'] = date('Y-m-d H:i:s');
			$update->update();  

        	return redirect(route('admin.system.angkatan'))->with('status', 'Angkatan success edited!');
		}	
	}

	public function store_edit_bidang_ilmu(Request $request)
	{
		# code...				
		$update = Bidang_ilmu::find($request->input('id'));

		$check = Bidang_ilmu::where('bidang_ilmu', $request->input('bidang_ilmu'))->first();

		if ($check){
        	return redirect(route('admin.system.bidang_ilmu.edit', $request->input('id')))->with('status', 'Bidang ilmu already exist!');
		}
		else{			
			$update['bidang_ilmu'] = $request->input('bidang_ilmu');			
			$update['updated_by'] = Auth::user()->username;		             	
			$update['updated_at'] = date('Y-m-d H:i:s');
			$update->update();  

        	return redirect(route('admin.system.bidang_ilmu'))->with('status', 'Bidang ilmu success edited!');
		}	
	}					

	public function store_edit_jurusan(Request $request)
	{
		# code...			
		$update = Jurusan::find($request->input('id'));

		// $check = Jurusan::where('jurusan', $request->input('jurusan'))->first();

		// if ($check){
  //       	return redirect(route('admin.system.jurusan.edit', $request->input('id')))->with('status', 'Jurusan already exist!');
		// }
		// else{			
			$update['jurusan'] = $request->input('jurusan');			
			$update['status_aktif'] = $request->input('status_active');			
			$update['updated_by'] = Auth::user()->username;		             	
			$update['updated_at'] = date('Y-m-d H:i:s');
			$update->update();  

        	return redirect(route('admin.system.jurusan'))->with('status', 'Jurusan success edited!');
		// }	
	}

	public function store_edit_topik_ta(Request $request)
	{
		# code...				
		$update = Topik_ta::find($request->input('id'));

		$check = Topik_ta::where('topik_ta', $request->input('topik_ta'))->first();

		if ($check){
        	return redirect(route('admin.system.topik_ta.edit', $request->input('id')))->with('status', 'Topik TA already exist!');
		}
		else{			
			$update['topik_ta'] = $request->input('topik_ta');			
			$update['updated_by'] = Auth::user()->username;		             	
			$update['updated_at'] = date('Y-m-d H:i:s');
			$update->update();  

        	return redirect(route('admin.system.topik_ta'))->with('status', 'Topik TA success edited!');
		}	
	}		

	public function add_new_mhs_to_user()
	{
		# code...
		$data['mhs'] = Mhs_model::where('verified_login', 0)->get();
		return view('admin.system.user_account_list.add_new_mhs_to_user', $data);
	}

	public function add_new_dosen_to_user()
	{
		# code...
		$data['dosen'] = Dosen_model::where('verified_login', 0)->get();
		return view('admin.system.user_account_list.add_new_dosen_to_user', $data);
	}		

	public function store_new_mhs_to_user($id)
	{
		# code...
		$find = Mhs_model::find($id);

		$insert = new User();
		$insert['username'] = $find->nim;
		$insert['name'] = $find->nama;
		$insert['role_id'] = 4;
		$insert['password'] = bcrypt($find->nim);
		$insert->save();

		$find['verified_login'] = 1;
		$find->update();

       	return redirect(route('admin.system.add_new_mhs_to_user'))->with('status', 'Mhs success added to user!');
	}	

	public function store_new_dosen_to_user($id)
	{
		# code...
		$find = Dosen_model::find($id);

		$insert = new User();
		$insert['username'] = $find->nip;
		$insert['name'] = $find->nama;
		$insert['role_id'] = 3;
		$insert['password'] = bcrypt($find->nip);
		$insert->save();

		$find['verified_login'] = 1;
		$find->update();

       	return redirect(route('admin.system.add_new_dosen_to_user'))->with('status', 'Dosen success added to user!');
	}	
}
