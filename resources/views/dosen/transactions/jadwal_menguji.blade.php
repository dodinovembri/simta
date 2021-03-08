@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Sempro</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Mahasiswa Sempro</h6>   
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
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Tanggal</th>
                        <th>Jadwal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($dosen as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                                <td>{{ $value->nim }}</td>                                
                                <td>{{ $value->ta_1->tanggal }}</td>                                
                                <td>{{ $value->ta_1->jadwal ." WIB"}}</td>                          
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