@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Bimbingan Skripsi</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Mahasiswa Bimbingan Skripsi</h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>                        
                        <th>Alamat</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th>Status Aktif</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($mhs as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nim }}</font></td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->angkatan }}</td>
                            <td>{{ $value->jurusan }}</td>
                            <td>{{ ($value->status_aktif == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>                                                  
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