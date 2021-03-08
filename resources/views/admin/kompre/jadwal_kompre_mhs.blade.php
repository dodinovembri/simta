@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa Memenuhi Syarat</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Pembimbing</h6>
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
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Dosen</th>
                          <th>For Note</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pembimbing as $key => $value)
                        <tr>
                          <th>1</th>
                          <td><span style="font-family: courier">{{$value->nip}}</span></td>
                          <td>{{$value->join_dosen->nama}}</td>
                          <td><input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Untuk catatan jam sementara"></td>                          
                        </tr>                        
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Penguji</h6>
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Dosen</th>
                          <th>For Note</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($set_penguji as $key => $value)
                        <tr>
                          <th>1</th>
                          <td><span style="font-family: courier">{{$value->nip}}</span></td>
                          <td>{{$value->dosen->nama}}</td>
                          <td><input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Untuk catatan jam sementara"></td>                          
                        </tr>                        
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Time picker</h6>
                <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('admin.transactions.store_jadwal_kompre')}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                
                  <input type="hidden" name="nim" value="{{ $id }}">
                  <label>Set Jadwal</label>                                                
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" name="tanggal"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                  </div> <br>                 
                  <div class="input-group date timepicker" id="datetimepickerExample" data-target-input="nearest">                    
                    <input type="text" class="form-control datetimepicker-input" name="jadwal" data-target="#datetimepickerExample"/>
                    <div class="input-group-append" data-target="#datetimepickerExample" data-toggle="datetimepicker">
                      <div class="input-group-text"><i data-feather="clock"></i></div>
                    </div>
                  </div>
                  <br>  
                  <input class="btn btn-primary" type="submit" value="Submit">
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection