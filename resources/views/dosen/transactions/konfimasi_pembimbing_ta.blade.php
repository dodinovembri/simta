@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembimbing TA</li>
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

                <h6 class="card-title">Konfirmasi Pembimbing TA</h6>
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
                      <?php $no=0; foreach ($dosen_pembimbing as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ $value->nim }}</font></td>
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