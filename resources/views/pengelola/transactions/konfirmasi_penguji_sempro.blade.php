@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Penguji Sempro</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Konfirmasi Penguji Sempro</h6>                
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
                        <th>NIP</th>                        
                        <th>Dosen Penguji</th>                                                                  
                        <th>Jadwal</th>                        
                        <th>Status TA</th>
                        <th>Ruangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($penguji_ta_1 as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nim }}</font></td>
                            <td><a href="#" data-toggle="modal" data-target="#exampleModal"><font face="Courier">{{ $value->nip }}</font></a></td>
                            <td>{{ $value->dosen->nama }}</td>                            
                            <td>{{ $value->jadwal. " WIB" }}</td>
                             <td>
                              @if($value->status_agree_penguji == 0)                          
                              <?php 
                                $now = \Carbon\Carbon::now();
                                $create = new \Carbon\Carbon($value->updated_at);                                    
                                $result = $create->diffInDays($now);                                
                              ?>
                              <span class="badge badge-danger">Belum Dperiksa sudah {{$result}} hari</span>
                              @elseif($value->status_agree_penguji == 1)
                                <span class="badge badge-primary">Disetujui</span>
                              @else
                                <span class="badge badge-info">Tidak Disetujui</span>                                
                              @endif
                            </td>
                            <td>{{ $value->ruangan }}</td>
                          </tr>    

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="POST" action="{{ route('pengelola.transactions.store_ubah_penguji', $value->id) }}">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Pembimbing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">                                              
                                      <div class="form-group">
                                        <label>Pilih Penguji Pengganti !</label>
                                            <select class="js-example-basic-single w-100" name="dosen">
                                              <?php foreach ($dosen as $key => $value) { ?>
                                                <option value="{{$value->nip}}">{{ $value->nama }}</option>
                                              <?php } ?>
                                            </select>
                                      </div> 
                                      <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Keterangan</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="ket" rows="5"></textarea>
                                      </div>                                                                       
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </form>
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