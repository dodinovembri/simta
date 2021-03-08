@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dosen</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Dosen List</h6> 
                @if(session()->has('message'))
                  <div class="alert alert-dismissible alert-fill-success" role="alert">
                    {{ session()->get('message') }}

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
                <a href="{{ route('admin.transactions.add_new_dosen') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add New Dosen</button></a><br><br>                   
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Name</th>                        
                        <th>Address</th>
                        <th>Bidang Ilmu</th>
                        <th>Verified Login</th>                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($dosen as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal2{{ $value->id }}"><font face="Courier">{{ $value->nip }}</font></a></td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->bidang_ilmu->bidang_ilmu }}</td>
                            <td>{{ $value->verified_login == 0 ? 'Not Verified' : 'Verified' }}</td>                            
                            <td>
                              <a href="{{ route('admin.transactions.edit_dosen', $value->id) }}"><i style="height: 50%" data-feather="edit-2"></i></a>
                              <a href="#"><i style="height: 50%" data-feather="delete" data-toggle="modal" data-target="#exampleModal{{ $value->id }}"></i></a>
                            </td>                          
                          </tr>    
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete dosen</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure to delete dosen : {{ $value->nama }} ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <a href="{{ route('admin.transactions.delete_dosen', $value->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->

                          <!-- Modal  -->
                          <div class="modal fade" id="exampleModal2{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Detail Dosen</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="nim" class="col-form-label">NIP :</label>
                                    <input type="text" class="form-control" value="{{$value->nip}}" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" value="{{$value->nama}}" readonly>
                                  </div>                                       
                                  <div class="form-group">
                                    <label for="judul_ta" class="col-form-label">Address:</label>
                                    <input type="text" class="form-control" value="{{$value->alamat}}" readonly>
                                  </div>  
                                  <div class="form-group">
                                    <label for="judul_ta" class="col-form-label">Bidang Ilmu:</label>
                                    <input type="text" class="form-control" value="{{$value->bidang_ilmu->bidang_ilmu}}" readonly>
                                  </div>                                                       
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Verified Login:</label>
                                    <input type="text" class="form-control" value="{{ $value->verified_login == 0 ? 'Not Verified' : 'Verified' }}" readonly>
                                  </div>                                                         
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
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