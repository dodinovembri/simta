@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Perpanjang Sempro</li>
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
                <h6 class="card-title">Konfirmasi Perpanjang Sempro</h6>                
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>                                                
                        <th>Judul TA</th>
                        <th>Status</th>
                        <th>Notes</th>                                                                      
                      </tr>
                    </thead>
                    <tbody>
                     <?php $no=0; foreach ($perpanjang_sempro as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>
                              <a href="{{route('dosen.transactions.detail_konfirmasi_sempro_mhs', $value->id)}}"><font face="Courier">{{ $value->nim }}</font></a>
                            </td>                            
                            <td>{{ substr($value->judul_ta, 0, 50) }}...</td>
                            <td>Unverified</td>
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