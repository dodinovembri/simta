@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Menguji Skripsi</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">List Jadwal Menguji Skripsi</h6>                
                  <div class="row">
                    <div class="table-responsive">

                      <table id="dataTableExample" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>NIP</th>                        
                            <th>Status Penguji</th>
                            <th>Status Persutujuan</th>
                            <th>Notes</th>
                            <th>Jadwal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=0; foreach ($penguji_ta_2 as $key => $value) { $no++; ?>
                              <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $value->nim }}</td>
                                <td>{{ $value->nip }}</td>
                                <td>{{ $value->status_penguji }}</td>
                                  <td>
                                    @if($value->status_agree_penguji == 0)
                                      <label for="" class="badge-pill badge-primary">{{ 'Belum Diperiksa'}}</label>
                                    @elseif($value->id_status_penguji == 1)
                                      <label for="" class="badge-pill badge-success">{{ 'Di setujui'}}</label>
                                    @else
                                      <label for="" class="badge-pill badge-danger">{{ 'Tidak disetujui'}}</label>
                                    @endif
                                  </td>
                                <td>{{ $value->ket }}</td>
                                <td>{{ $value->jadwal ." WIB"}}</td>
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

      </div>
@endsection