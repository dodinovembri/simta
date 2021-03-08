@extends('layouts.admin_dashboard')

@section('content')
			<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
			            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.master.syarat_ta_2') }}">Syarat Kompre</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Edit Syarat Kompre</li>			
					</ol>
				</nav>

				<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Form Edit Syarat Kompre</h4>
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
								<form class="cmxform" id="signupForm" method="POST" action="{{ route('admin.transactions.store_edit_syarat_kompre', $syarat_ta_2->id ) }}">
	                  				<input type="hidden" name="_token" value="{{ csrf_token() }}">		
									<div class="form-group row">
										<div class="col-lg-3">
											<label class="col-form-label">Syarat Kompre</label>
										</div>
										<div class="col-lg-8">
											<input class="form-control" maxlength="25" id="defaultconfig" type="text" name="syarat_kompre" placeholder="Syarat Kompre" value="{{$syarat_ta_2->file_name}}" required>
										</div>
									</div><br>
									<div class="form-group mb-0 row">
										<div class="col-lg-3">											
										</div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</div>										
								</form>															
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection