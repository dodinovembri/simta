@extends('layouts.admin_dashboard')

@section('content')

      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New User</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Add New User</h6>
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif                 
                <form class="forms-sample" method="POST" action="{{ route('admin.system.store_new_user') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Full Name</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="Username" placeholder="Full Name" name="name" value="{{ old('name') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUsername1">Username</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="Username" placeholder="Username" name="username" value="{{ old('name') }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password" name="password_confirmation">
                  </div>     
                  <br>                 
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <a href="{{ route('admin.system.user_account_list') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>   
@endsection