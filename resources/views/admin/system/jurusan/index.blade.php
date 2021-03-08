@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jurusan</li>
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
                <a href="{{ route('admin.system.add_new_jurusan') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add New Jurusan</button></a> <br><br>                              
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Topik TA</th>
                        <th>Status</th>                                                
                        <th>Created By</th>                                                
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($jurusan as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $value->jurusan }}</td>
                            <td>{{ $value->status_aktif == 1 ? 'Active' : 'Inactive' }}</td>                            
                            <td>{{ $value->created_by }}</td>                            
                            <td>
                              <a href="#"><i style="height: 50%" data-feather="search" data-toggle="modal" data-target="#exampleModal2{{ $value->id }}"></i></a>
                              <a href="{{ route('admin.system.jurusan.edit', $value->id) }}"><i style="height: 50%" data-feather="edit-2"></i></a>
                              <a href="#"><i style="height: 50%" data-feather="delete" data-toggle="modal" data-target="#exampleModal{{ $value->id }}"></i></a>
                            </td>                          
                          </tr>    
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Jurusan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure to delete jurusan : {{ $value->jurusan }} ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <a href="{{ route('admin.system.jurusan.delete', $value->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Jurusan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Jurusan : {{ $value->jurusan }}
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