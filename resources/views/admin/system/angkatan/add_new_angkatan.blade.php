@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Angkatan</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Add New Angkatan</h6>
                @if(session()->has('status'))
                  <div class="alert alert-dismissible alert-fill-danger" role="alert">
                    {{ session()->get('status') }}

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
                <form class="forms-sample" method="POST" action="{{ route('admin.system.store_new_angkatan') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Angkatan</label>
                    <input type="text" name="angkatan" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Angkatan">
                  </div>
                  <br>
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <a href="{{ route('admin.system.angkatan') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>   
@endsection