@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengelola</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setuju Topik TA</li>
          </ol>
        </nav>
        <div class="row">
          <div class="col-6 col-md-6 col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="card text-white bg-secondary">
                  <div class="card-header">{{$mhs->nim}}</div>
                  <div class="card-body">
                    <h5 class="card-title">{{$mhs->topik_ta->topik_ta}}</h5>
                    <p class="card-text">{{$mhs->judul_ta}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>           
        </div>  
        <br>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Persetujuan Topik TA</h6>
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
                <form class="forms-sample" method="POST" action="{{ route('pengelola.transactions.store_setuju_topik_ta_by_pengelola') }}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="nim" value="{{$mhs->nim}}">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="persetujuan" id="optionsRadios" value="2">
                      Setuju
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="persetujuan" id="optionsRadios" value="3">
                      Tidak Setuju
                    </label>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Keterangan</label>
                    <textarea class="form-control" name="ket" id="exampleFormControlTextarea1" rows="5"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <a href="{{ route('pengelola.transactions.menyetujui_topik_ta') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                </form>
              </div>
            </div>            
          </div>
        </div>         

      </div>
@endsection      
