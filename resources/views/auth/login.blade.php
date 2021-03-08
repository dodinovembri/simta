@extends('layouts.auth')

@section('content')

	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">

                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">SIMTA <span>SI</span></a>
                    <h5 class="text-muted font-weight-normal mb-4">Welcome to SIMTA! Log in to your account.</h5>
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
                    <form class="forms-sample" role="form" method="POST" action="{{ url('/auth/login') }}">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Remember me
                        </label>
                      </div>
                      <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</button>                        
                      </div>
                      <a href="{{ url('/password/email') }}" class="d-block mt-3 text-muted">Forgot Your Password?</a>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection
