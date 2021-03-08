@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Jadwal Sempro</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
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
                <h6 class="card-title">Konfirmasi Jadwal Sempro</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>NIP</th>
                        <th>Status</th>
                        <th>Notes</th>                  
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($mhs as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal2{{ $value->nim }}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td><font face="Courier">{{ $value->nip }}</font></td>
                            <td>
                              @if($value->id_status_penguji == 0)
                              <span class="badge badge-primary">Belum Diperiksa</span>                                
                              @elseif($value->id_status_penguji == 1)
                              <span class="badge badge-success">Di setujui</span>                                
                              @else
                              <span class="badge badge-danger">Tidak disetujui</span>                                
                              @endif
                            </td>
                            <td>{{ $value->ket }}</td>
                          </tr>                      
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{ $value->nim }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Jadwal</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="nim" class="col-form-label">NIM Mahasiswa:</label>
                                    <input type="text" class="form-control" value="{{$value->nim}}" readonly>
                                  </div>
                                  <form method="POST" action="{{ route('dosen.transactions.store_konfirmasi_jadwal_sempro_no', $value->nim) }}">  
                                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                      <div class="form-group">
                                        <label for="nama_mahasiswa" class="col-form-label">Alasan Jika Tidak bisa<span style="color: red">*</span> :</label>
                                        <textarea rows="5" name="ket" type="text" class="form-control" required=""> </textarea>
                                      </div>     
                                      <button type="submit" class="btn btn-danger">Tidak Bisa</button> <br><br>   
                                  </form>
                                
                                  <a href="{{ route('dosen.transactions.store_konfirmasi_jadwal_sempro_yes', $value->nim) }}"><button type="button" class="btn btn-primary">Bersedia</button></a>
                                
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