@extends('layouts.pengelola_dashboard')

@section('content')

      <div class="page-content">

        <div class="profile-page tx-13">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Change Password</h6>
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
                  <form class="forms-sample" method="POST" action="{{ route('pengelola.store_update_pass', $profile) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                           
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Confirm Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Confirm Password" required>
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
          </div>
        </div>

      </div>
@endsection