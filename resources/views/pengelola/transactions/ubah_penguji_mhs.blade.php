@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Memenuhi Syarat</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-12 col-md-12 col-xl-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Mahasiswa</h5>
                <p class="card-text">NIM : <span style="font-family: courier"> {{$mhs->nim}}</p>      
                <p class="card-text">Nama : {{$mhs->join_mhs->nama}} </p>                
                <p class="card-text">Topik TA : {{$topik_ta->topik_ta->topik_ta}} </p>
                <p class="card-text">Judul TA : {{$topik_ta->judul_ta}} </p>
                <?php foreach ($pembimbing as $key => $value) { ?>
                  <p class="card-text">Pembimbing I :<span style="font-family: courier"> {{$value->nip}}</span> </p>  
                <?php } ?>                                        
              </div>
            </div>
          </div>
        </div><br>  


        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Basic Table</h6>
                <p class="card-description">Add class <code>.table</code></p>
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIP Penguji</th>
                          <th>Nama Penguji</th>                          
                          <th>Status Penguji</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no =0; foreach ($penguji as $key => $value) { $no++; ?>
                            <tr>
                              <th>{{$no}}</th>
                              <th>{{$value->nip}}</th>
                              <th>{{$value->dosen->nama}}</th>
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