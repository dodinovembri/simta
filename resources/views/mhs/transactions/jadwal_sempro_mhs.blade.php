@extends('layouts.mhs_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Kompre</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <?php if (isset($ta)) { ?>
                  <?php if ($cek == 0) { ?>
                    <h6 class="card-title">Jadwal Kompre {{ $ta->nim}}</h6>                
                    <table>                

                      <tr> 
                        <td>Tanggal </td> 
                        <td>{{" &nbsp; : &nbsp;".$ta->tanggal }}</td>
                      </tr>
                      <tr> 
                        <td>Jadwal  </td> 
                        <td>{{" &nbsp; : &nbsp;".$ta->jadwal }}</td>
                      </tr>
                      <tr> 
                        <td>Ruangan </td> 
                        <td>{{" &nbsp; : &nbsp;".$ta->ruangan }}</td>
                      </tr>
                      <?php foreach ($penguji as $key => $value) { ?>
                        <tr> 
                          <td>Penguji </td> 
                          <td>{{" &nbsp; : &nbsp;".$value->nama_dosen }}</td>
                        </tr>
                      <?php } ?>

                    </table>    
                  <?php } else{ ?>
                    <div class="alert alert-warning" role="alert">Jadwal Sempro anda belum tersedia</div><br>
                  <?php } ?>                
                <?php } else{ ?>
                  <div class="alert alert-warning" role="alert">Jadwal Sempro anda belum tersedia</div><br>
                <?php } ?>
                <br>
                <h6 class="card-title">List Jadwal Semrpro Semua Mahasiswa</h6>                          
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Tanggal</th>
                        <th>Jadwal</th>
                        <th>Status Kompre</th>                        
                        <th>Ruangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($ta_all as $key => $value) { $no++; ?>
                          <tr>
                            <td>{{ $no }}</td>
                            <td><font face="Courier">{{ !empty($value->nim) ? $value->nim : '-' }}</font></td>
                            <td>{{ !empty($value->tanggal) ? $value->tanggal : '-' }}</td>
                            <td>{{ !empty($value->jadwal) ? $value->jadwal : '-' }}</td>
                            <td><?php if ($value->id_status_ta_1 == 4) { ?>
                              <span class="badge badge-danger">Belum Terjadwal</span>
                            <?php } elseif ($value->id_status_ta_1 == 7) { ?>
                              <span class="badge badge-primary">Sudah Terjadwal</span>
                            <?php } ?></td>
                            <td>{{ !empty($value->ruangan) ?$value->ruangan : '-' }}</td>
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