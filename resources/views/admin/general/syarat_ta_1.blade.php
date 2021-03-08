@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Syarat Sempro</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Syarat Sempro</h6>  
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
                <a href="{{ route('admin.transactions.add_new_syarat_sempro') }}"><button type="button" class="btn btn-primary mb-1 mb-md-0">Add New Syarat Sempro</button></a><br><br>              
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Syarat Sempro</th>                                          
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($syarat_ta_1 as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $value->file_name }}</td>                          
                            <td>
                              <a href="{{ route('admin.transactions.edit_syarat_ta_1', $value->id) }}"><i style="height: 50%" data-feather="edit-2"></i></a>
                              <a href="#"><i style="height: 50%" data-feather="delete" data-toggle="modal" data-target="#exampleModal{{ $value->id }}"></i></a>
                            </td>                          
                          </tr>    
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete syarat sempro</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure to delete syarat sempro : {{ $value->file_name }} ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <a href="{{ route('admin.transactions.delete_syarat_ta_1', $value->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->    
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