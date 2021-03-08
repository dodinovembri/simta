@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <div class="profile-page tx-13">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Edit Profile</h6>
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
                  <form class="forms-sample" method="POST" action="{{ route('pengelola.edit_profile', $profile->username) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                           
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIM</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nim" value="{{$profile->username}}" id="exampleInputUsername2" placeholder="NIM" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" value="{{$profile->name}}" id="exampleInputEmail2" autocomplete="off" placeholder="Nama">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>                        
                      </div>
                    </div>                    
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Profile</h6>
                  <form class="forms-sample">                  
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIM</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nim" value="{{$profile->username}}" id="exampleInputUsername2" placeholder="NIM" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" name="nama" value="{{$profile->name}}" id="exampleInputEmail2" autocomplete="off" placeholder="Nama" disabled>
                      </div>
                    </div>                  
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection