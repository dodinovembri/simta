@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Account List</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Jurusan</h6> 
                @if(session()->has('status'))
                  <div class="alert alert-dismissible alert-fill-danger" role="alert">
                    {{ session()->get('status') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif


                @if($errors->any())
                  <div class="alert alert-dismissible alert-fill-danger" role="alert">
                       @foreach ($errors->all() as $error)
                           {{$error}}<br/>
                       @endforeach

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif  
<!--                 <a href="{{ route('admin.system.add_new_user') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add New User Account List</button></a> -->
                <a href="{{ route('admin.system.add_new_mhs_to_user') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add Mhs as New User</button></a>
                <a href="{{ route('admin.system.add_new_dosen_to_user') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add Dosen as New User</button></a> <br><br>                              
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>                                                
                        <th>Role</th>                                                
                        <th>Created At</th>                                                
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($user as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $value->name }}</td>
                            <td><font face="Courier">{{ $value->username }}</font></td>                            
                            <td>{{ $value->role_id }}</td>                            
                            <td>{{ $value->created_at }}</td>                            
                            <td>
                              <a href="#"><i style="height: 50%" data-feather="search" data-toggle="modal" data-target="#exampleModal2{{ $value->id }}"></i></a>
<!--                               <a href="{{ route('admin.system.topik_ta.edit', $value->id) }}"><i style="height: 50%" data-feather="edit-2"></i></a> -->
                              <a href="#"><i style="height: 50%" data-feather="delete" data-toggle="modal" data-target="#exampleModal{{ $value->id }}"></i></a>
                            </td>                          
                          </tr>    
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure to delete user : {{ $value->username }} ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <a href="{{ route('admin.system.user.delete', $value->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">User Account</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Username : {{ $value->username }}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>              
                              </div>
                            </div>
                          </div>        

                        </div>    
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>   
@endsection