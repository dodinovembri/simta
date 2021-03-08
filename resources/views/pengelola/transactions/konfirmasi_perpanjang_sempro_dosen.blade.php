@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pengelola.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Perpanjang Sempro dari Dosen</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Konfirmasi Perpanjang Sempro dari Dosen</h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>                        
                        <th>Pembimbing Skripsi</th>
                        <th>Status Agree</th>
                        <th>File Perpanjang</th>
                        <th>Ket</th>                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($konfirmasi_pembimbing as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nim }}</font></td>
                            <td>{{ $value->mhs_name }}</td>
                            <td>{{ $value->dosen_name }}</td>
                            <td><?php if ($value->id_status_agree_perpanjang == 0) {
                              echo '<span class="badge badge-primary">Belum Mengajukan</span>';
                            } elseif ($value->id_status_agree_perpanjang == 1) {
                              echo '<span class="badge badge-secondary">Menunggu Konfirmasi</span>';
                            } elseif ($value->id_status_agree_perpanjang == 2) {
                              echo '<span class="badge badge-success">Disetujui</span>';
                            } elseif ($value->id_status_agree_perpanjang == 3) {
                              echo '<span class="badge badge-danger">Ditolak</span>';
                            } else{
                              echo '<span class="badge badge-warning">Hubungi administrator</span>';
                            } ?></td>
                            <td>{{ $value->file_perpanjang }}</td>
                            <td>{{ $value->ket }}</td>                                                 
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