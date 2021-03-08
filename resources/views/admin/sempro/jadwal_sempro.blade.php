@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Memenuhi Syarat</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Mahasiswa Memenuhi Syarat</h6>  
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
                        <th>Nama</th>                        
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Ruangan</th>                                                                
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($jadwal_sempro as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="{{route('admin.transactions.jadwal_sempro_mhs', $value->nim)}}"><span style="font-family: courier">{{ $value->nim }}</span></a></td>
                            <td>{{ $value->join_mhs->nama }}</td>
                            <td>{{ $value->jadwal }}</td>
                            <td><?php if ($value->id_status_ta_1 == 4) { ?>
                              <span class="badge badge-danger">Belum Terjadwal</span>
                            <?php } elseif ($value->id_status_ta_1 == 7) { ?>
                              <span class="badge badge-primary">Sudah Terjadwal</span>
                            <?php } ?></td>
                            <td>{{ $value->ruangan }}</td>                                                                                
                          </tr>    
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