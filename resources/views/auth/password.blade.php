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
                    <h5 class="text-muted font-weight-normal mb-4">Please fill your email to send password reset link</h5>
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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
                    <form class="forms-sample" role="form" method="POST" action="{{ url('/password/email') }}">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}">
                      </div>                     
                      <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Send Password Reset Link</button>                       
                      </div>
                      <a href="{{ url('/auth/login') }}" class="d-block mt-3 text-muted">Login?</a>
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
