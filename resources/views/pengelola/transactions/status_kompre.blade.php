@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengelola</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Kompre</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title"></h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>                        
                        <th>Tanggal</th>
                        <th>Status Kompre</th>
                        <th>Nama Dosen</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($status_kompre as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal2{{ $value->nim }}"><font face="Courier">{{ $value->nim_mahasiswa }}</font></a></td>
                            <td>{{ $value->nama_mahasiswa }}</td>
                            <td>{{ $value->tanngal }}</td>
                            <td>                
                            <?php if ($value->id_status_ta_1 == 1) { ?>
                                <span class="badge badge-secondary">Menunggu Verifikasi Admin</span>                              
                              <?php } elseif ($value->id_status_ta_1 == 2) { ?>
                                <span class="badge badge-success">Data anda sudah diverifikasi admin</span>
                              <?php } elseif ($value->id_status_ta_1 == 3) { ?>
                                <span class="badge badge-danger">Data mhs tidak lengkap</span>
                              <?php } elseif ($value->id_status_ta_1 == 4) { ?>
                                <span class="badge badge-success">Penguji anda sudah di atur</span>
                              <?php } elseif ($value->id_status_ta_1 == 5) { ?>
                                <span class="badge badge-success">Mhs sudah sempro</span>                                
                              <?php } elseif ($value->id_status_ta_1 == 6) { ?>
                                <span class="badge badge-success">Mhs gagal dalam sempro ini</span>
                              <?php }  elseif ($value->id_status_ta_1 == 7) { ?>
                                <span class="badge badge-success">Jadwal Mhs Sudah di Atur</span>                                
                              <?php } else{ ?>      
                                <span class="badge badge-success">Silahkan hubungi administrator</span>
                              <?php } ?>
                            </td>
                            <td>{{ $value->nama_penguji }}</td>                     
                        
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
                                    <input type="text" class="form-control" id="nama_mahasiswa" readonly>
                                  </div>      
                                  <div class="form-group">
                                    <label for="judul_ta" class="col-form-label">Judul TA:</label>
                                    <input type="text" class="form-control" id="judul_ta" readonly>
                                  </div>                    
                                  <div class="form-group">
                                    <label for="jadwal_sempro" class="col-form-label">Jadwal SEMPRO:</label>
                                    <input type="text" class="form-control" id="jadwal_sempro" readonly>
                                  </div>                  
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="penguji_1" class="col-form-label">Penguji SEMPRO 1:</label>
                                        <input type="text" class="form-control" id="penguji_1" readonly>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="agree_1" class="col-form-label">Status Konfirmasi 1:</label>
                                        <input type="text" class="form-control" id="agree_1" readonly>
                                      </div>
                                    </div>
                                  </div>        
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="penguji_2" class="col-form-label">Penguji SEMPRO 2:</label>
                                        <input type="text" class="form-control" id="penguji_2" readonly>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="agree_2" class="col-form-label">Status Konfirmasi 2:</label>
                                        <input type="text" class="form-control" id="agree_2" readonly>
                                      </div>
                                    </div>
                                  </div>        
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="penguji_3" class="col-form-label">Penguji SEMPRO 3:</label>
                                        <input type="text" class="form-control" id="penguji_3" readonly>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="agree_3" class="col-form-label">Status Konfirmasi 3:</label>
                                        <input type="text" class="form-control" id="agree_3" readonly>
                                      </div>
                                    </div>
                                  </div>                     
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="penguji_4" class="col-form-label">Penguji SEMPRO 4:</label>
                                        <input type="text" class="form-control" id="penguji_4" readonly>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="agree_4" class="col-form-label">Status Konfirmasi 4:</label>
                                        <input type="text" class="form-control" id="agree_4" readonly>
                                      </div>
                                    </div>
                                  </div>                  
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label for="penguji_5" class="col-form-label">Penguji SEMPRO 5:</label>
                                        <input type="text" class="form-control" id="penguji_5" readonly>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="agree_5" class="col-form-label">Status Konfirmasi 5:</label>
                                        <input type="text" class="form-control" id="agree_5" readonly>
                                      </div>
                                    </div>
                                  </div>                                                                                        
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
