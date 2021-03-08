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
                  <p class="card-text">Pembimbing I :<span style="font-family: courier"> {{$value->join_dosen->nama}}</span> </p>  
                <?php } ?>                                        
              </div>
            </div>
          </div>
        </div><br>  

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Set Penguji</h4>
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
                <div class="form-group">
                <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_penguji_sempro_mhs')}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="nim" value="{{$mhs->nim}}">
                  <?php foreach ($pembimbing as $key => $value) { ?>
                    <input type="hidden" name="penguji[]" value="{{ $value->nip }}">
                  <?php } ?>                                  
                  <label>Ketua Penguji</label>                                          
                  <select class="js-example-basic-single w-100" name="penguji[]">
                    <option>Pilih Dosen</option>
                    @foreach ($dosen as $key => $value)
                    <option value="{{$value->nip}}">{{$value->nama}}</option>                
                    @endforeach
                  </select><br> <br>  
                  <label>Penguji I</label>
                  <select class="js-example-basic-single w-100" name="penguji[]">
                    <option>Pilih Dosen</option>                    
                    @foreach ($dosen as $key => $value)
                    <option value="{{$value->nip}}">{{$value->nama}}</option>                
                    @endforeach
                  </select><br> <br>  
                  <label>Penguji II</label>
                  <select class="js-example-basic-single w-100" name="penguji[]">
                    <option>Pilih Dosen</option>                    
                    @foreach ($dosen as $key => $value)
                    <option value="{{$value->nip}}">{{$value->nama}}</option>                
                    @endforeach
                  </select>
                  <br>  <br>  <br>  
                  <input class="btn btn-primary" type="submit" value="Submit"> 
                </form>               
                </div>               
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection