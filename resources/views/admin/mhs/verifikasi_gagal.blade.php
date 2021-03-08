@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Gagal Verifikasi</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Mahasiswa Gagal Verifikasi</h6>   
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
                        <th>Alamat</th>
                        <th>Status KKT File</th>
                        <th>Angkatan</th>
                        <th>Jurusan</th>
                        <th>Status Aktif</th>                                                
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($verifikasi_gagal as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal2{{ $value->nim }}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td><?php if ($value->status_kkt_file == 0) { ?>
                              <span class="badge badge-danger">Unverified</span>
                            <?php } elseif ($value->status_kkt_file == 1) { ?>
                              <span class="badge badge-success">Waiting Verified</span>
                            <?php }elseif ($value->status_kkt_file == 2) { ?>
                              <span class="badge badge-success">Verified</span>
                            <?php }elseif ($value->status_kkt_file == 3) { ?>
                              <span class="badge badge-danger">Rejected</span>
                            <?php } ?></td>
                            <td>{{ !empty($value->angkatan->angkatan) ? $value->angkatan->angkatan : '-' }}</td>
                            <td>{{ !empty($value->jurusan->jurusan) ? $value->jurusan->jurusan : '-' }}</td>
                            <td>{{ ($value->status_aktif == 1) ? 'Aktif' : 'Tidak Aktif' }}</td>   
                          </tr>                              
                          <!-- Modal  -->
                          <div class="modal fade" id="exampleModal2{{ $value->nim }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="nim" class="col-form-label">NIM Mahasiswa:</label>
                                    <input type="text" class="form-control" value="{{$value->nim}}" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Nama Mahasiswa:</label>
                                    <input type="text" class="form-control" value="{{$value->nama}}" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_mahasiswa" class="col-form-label">Dosen Pembimbing:</label>
                                    <input type="text" class="form-control" value="{{!empty($value->nip_dosen->nama) ? $value->nip_dosen->nama : '-' }}" readonly>
                                  </div>                                        
                                  <div class="form-group">
                                    <label for="judul_ta" class="col-form-label">Alamat:</label>
                                    <input type="text" class="form-control" value="{{$value->alamat}}" readonly>
                                  </div>                    
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Status KKT File:</label>
                                    <input type="text" class="form-control" value="<?php if ($value->status_kkt_file == 0) {
                                    # code...
                                    echo "Unverified";
                                  }elseif ($value->status_kkt_file == 1) {
                                    # code...
                                    echo "Verified";
                                  } elseif ($value->status_kkt_file == 2) {
                                    # code...
                                    echo "Rejected";
                                  } ?>" readonly>
                                  </div> 
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Angkatan:</label>
                                    <input type="text" class="form-control" value="{{ $value->angkatan->angkatan }}" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Jurusan:</label>
                                    <input type="text" class="form-control" value="{{ $value->jurusan->jurusan }}" readonly>
                                  </div> 
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Status Aktif:</label>
                                    <input type="text" class="form-control" value="{{ ($value->status_aktif == 1) ? 'Aktif' : 'Tidak Aktif' }}" readonly>
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