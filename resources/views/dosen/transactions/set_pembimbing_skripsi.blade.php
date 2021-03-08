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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($set_pembimbing_skripsi as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->id_topik_ta }}</td>
                            <td>{{ $value->judul_ta }}</td>
                            <td>{{ $value->id_status_agree_topik }}</td>                          
                            <td>{{ $value->created_by }}</td>                                                  
                            <td>
                              <a href=""><i style="height: 50%" data-feather="search"></i></a>
                              <a href=""><i style="height: 50%" data-feather="edit-2"></i></a>
                              <a href=""><i style="height: 50%" data-feather="delete"></i></a>
                            </td>                          
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