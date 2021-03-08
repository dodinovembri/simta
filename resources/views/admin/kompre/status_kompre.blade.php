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
                <h6 class="card-title">List Mahasiswa Memenuhi Syarat</h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Jadwal</th>                        
                        <th>Status Sempro</th>
                        <th>Ruangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($ta_2 as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal{{$value->nim}}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td>{{ $value->jadwal }}</td>
                            <td><?php if ($value->id_status_ta_2 == 4) { ?>
                              <span class="badge badge-danger">Belum Terjadwal</span>
                            <?php } elseif ($value->id_status_ta_2 == 7) { ?>
                              <span class="badge badge-primary">Sudah Terjadwal</span>
                            <?php } ?></td> 
                            <td>{{ $value->ruangan }}</td>
                            

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{ $value->nim }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Mhs ini Sudah kompre?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="nim" class="col-form-label">NIM Mahasiswa:</label>
                                    <input type="text" class="form-control" value="{{$value->nim}}" readonly>
                                  </div><br><br>
                                  <a href="{{ route('dosen.transactions.store_konfirmasi_sudah_kompre', $value->nim) }}"><button type="button" class="btn btn-primary">Sudah Kompre</button></a>
                                
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->                             
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