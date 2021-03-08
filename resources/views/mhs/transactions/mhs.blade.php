@extends('layouts.mhs_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Mahasiswa</h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>                        
                        <th>Alamat</th>
                        <th>Status KKT File</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th>Status Aktif</th>                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($mhs as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->status_kkt_file }}</td>
                            <td>{{ $value->id_angkatan }}</td>
                            <td>{{ $value->id_jurusan }}</td>
                            <td>{{ $value->status_aktif }}</td>                          
                            <td>
                              <a href=""><i style="height: 50%" data-feather="search"></i></a>
                              <a href=""><i style="height: 50%" data-feather="edit-2"></i></a>
                              <a href=""><i style="height: 50%" data-feather="delete"></i></a>
                            </td>                          
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