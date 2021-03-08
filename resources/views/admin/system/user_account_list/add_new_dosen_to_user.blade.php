@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Dosen to User</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Dosen Not Verified Login</h6> 
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
<!--                 <a href="{{ route('admin.system.add_new_user') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Verified All</button></a>                                <br><br> -->
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th><input type="checkbox" name=""></th>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>                                                
                        <th>Alamat</th>                                                
                        <th>Created At</th>                                                
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($dosen as $key => $value) { $no++; ?>
                          <tr>
                            <td><input type="checkbox" name=""></td>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nip }}</font></td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>                                                        
                            <td>{{ $value->created_at }}</td>                            
                            <td>
                              <a href="{{ route('admin.system.store_new_dosen_to_user', $value->id) }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Verified</button></a>
                            </td>                          
                          </tr>         

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