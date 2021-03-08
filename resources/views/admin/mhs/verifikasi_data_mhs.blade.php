@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi Data Mahasiswa</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Verifikasi Data Mahasiswa</h6>                                           
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($verifikasi_data_mhs as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="{{ route('admin.transactions.verifikasi_data_mhs_detail', $value->nim) }}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td><?php if ($value->status_kkt_file == 0) { ?>
                              <span class="badge badge-danger">Unverified</span>
                            <?php } elseif ($value->status_kkt_file == 1) { ?>
                              <span class="badge badge-success">Waiting Verified</span>
                            <?php }elseif ($value->status_kkt_file == 2) { ?>
                              <span class="badge badge-success">Verified</span>
                            <?php }elseif ($value->status_kkt_file == 3) { ?>
                              <span class="badge badge-success">Rejected</span>
                            <?php } ?></td>
                            <td>{{ !empty($value->angkatan->angkatan) ? $value->angkatan->angkatan : '-' }}</td>
                            <td>{{ !empty($value->jurusan->jurusan) ? $value->jurusan->jurusan : '-' }}</td>
                            <td>{{ ($value->status_aktif == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>   
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