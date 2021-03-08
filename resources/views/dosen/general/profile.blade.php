@extends('layouts.dosen_dashboard')

@section('content')

      <div class="page-content">

        <div class="profile-page tx-13">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Edit Profile</h6>
                  <form class="forms-sample" method="POST" action="{{ route('dosen.edit_profile', $profile->username) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                        
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Photo</label>
                      <div class="col-sm-9">
                        <input type="file" name="photo" class="file-upload-default">      
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" name="photo" placeholder="Ubah Foto Profil">
                            <span class="input-group-append">
                               <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                         </div>                                          
                      </div>
                    </div>                    
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIM</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nim" value="{{$profile->username}}" id="exampleInputUsername2" placeholder="NIM" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" value="{{$profile->join_dosen->nama}}" id="exampleInputEmail2" autocomplete="off" placeholder="Nama">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="8">{{$profile->join_dosen->alamat}}</textarea>                    
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
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                        <img class="profile-pic" src="{{ asset('assets/images') }}/{{$profile->join_dosen->photo}}" width="50" alt="profile">
                      </div>
                    </div>                   
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">NIM</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nim" value="{{$profile->username}}" id="exampleInputUsername2" placeholder="NIM" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" name="nama" value="{{$profile->join_dosen->nama}}" id="exampleInputEmail2" autocomplete="off" placeholder="Nama" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="8" disabled>{{$profile->join_dosen->alamat}}</textarea>                    
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