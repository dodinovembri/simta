@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topik TA Mahasiswa</li>
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

                <h6 class="card-title">List Topik TA Mahasiswa</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Topik TA</th>
                        <th>Judul TA</th>
                        <th>Status Agree Topik</th>
                        <th>Created By</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($topik_ta_mhs as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><a href="{{route('dosen.transactions.detail_topik_ta_mhs', $value->id)}}"><font face="Courier">{{ $value->nim }}</font></a></td>
                            <td>{{ $value->topik_ta->topik_ta }}</td>
                            <td>{{ substr($value->judul_ta, 0, 50) }}...</td>
                            <td>
                              @if($value->id_status_agree_topik == 1)
                                <span class="badge badge-primary">Belum Diperiksa</span>                                
                              @elseif($value->id_status_agree_topik == 2)
                                <span class="badge badge-success">Di setujui</span>                                
                              @else
                                <span class="badge badge-danger">Tidak disetujui</span>                                
                              @endif
                            </td>
                            <td>{{ $value->created_by }}</td>
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