@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Penguji Skripsi</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Konfirmasi Penguji Skripsi</h6>                
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
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($penguji_ta_2 as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nim }}</font></td>
                            <td><font face="Courier">{{ $value->nip }}</font></td>
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