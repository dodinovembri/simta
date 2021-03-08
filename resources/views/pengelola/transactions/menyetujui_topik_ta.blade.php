@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mhs Topik TA</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Mhs Topik TA</h6>     
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
                        <th>Topik TA</th>                        
                        <th>Status</th>
                        <th>Judul TA</th>
                        <th>Keterangan</th>                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($topik_ta as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="{{ route('pengelola.transactions.setuju_topik_ta', $value->nim) }}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td>{{ $value->topik_ta->topik_ta }}</td>
                            <td>
                              <?php if ($value->id_status_agree_topik == 0) { ?>
                                <span class="badge badge-secondary">Mhs belum mengajukan topik TA</span>
                            <?php } elseif ($value->id_status_agree_topik == 1) { ?>
                              <span class="badge badge-info">Menunggu konfirmasi pembimbing akademik terkait topik yang diajukan</span>
                            <?php } elseif ($value->id_status_agree_topik == 2) { ?>
                              <span class="badge badge-primary">Topik TA disetujui pembimbing, sisa batas waktu pendaftaran sempro
                                <?php 
                                    $now = \Carbon\Carbon::now();
                                    $create = new \Carbon\Carbon($value->created_at);                                    
                                    $result = 30 - $create->diffInDays($now);

                                    echo $result; 

                                ?> hari</span>                              
                            <?php } elseif ($value->id_status_agree_topik == 2 && $result >= 30) { ?>
                              <span class="badge badge-danger">Waktu pengajuan sempro, lakukan perubahan topik TA</span>                               
                            <?php } elseif ($value->id_status_agree_topik == 3) { ?>
                              <span class="badge badge-warning">Topik TA tidak disetujui pembimbing</span>                
                            <?php } else{ ?>
                              <span class="badge badge-light">Silahkan hubungi administrator!</span>
                            <?php } ?>
                            </td>                            
                            <td>{{ $value->judul_ta }}</td>                            
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