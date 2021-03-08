@extends('layouts.admin_dashboard')

@section('content')
			<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
			            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.master.mhs') }}">Mahasiswa</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Add New Mahasiswa</li>			
					</ol>
				</nav>

				<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Form Add New Mahasiswa</h4>	
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
								<form class="cmxform" id="signupForm" method="POST" action="{{ route('admin.transactions.store_new_mhs') }}">
	                  				<input type="hidden" name="_token" value="{{ csrf_token() }}">		
									<div class="form-group row">
										<div class="col-lg-3">
											<label class="col-form-label">NIM</label>
										</div>
										<div class="col-lg-9">
											<input class="form-control" maxlength="25" id="defaultconfig" type="text" name="nim" placeholder="NIM" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-3">
											<label class="col-form-label">Full Name</label>
										</div>
										<div class="col-lg-9">
											<input class="form-control" maxlength="60" id="defaultconfig-2" type="text" name="full_name" placeholder="Full Name" required>
										</div>
									</div>
									<div class="form-group mb-0 row">
										<div class="col-lg-3">
											<label>Pembimbing Akademik</label>
										</div>
										<div class="col-lg-9">
											<select class="js-example-basic-single w-100" name="dosen" required>
												<option>Select Dosen</option>
											<?php foreach ($dosen as $key => $value) { ?>
													<option value="{{ $value->nip }}">{{ $value->nama }}</option>	
											<?php } ?>										
											</select>
										</div>
									</div>										
									<div class="form-group mb-0 row">
										<div class="col-lg-3">
											<label class="col-form-label">Address</label>
										</div>
										<div class="col-lg-9">
											<textarea id="maxlength-textarea" class="form-control" name="address" maxlength="500" rows="8" placeholder="Address"></textarea>
										</div>
									</div>
									<div class="form-group mb-0 row">
										<div class="col-lg-3">
											<label>Angkatan</label>
										</div>
										<div class="col-lg-9">
											<select class="js-example-basic-single w-100" name="angkatan" required>
												<option>Select Angkatan</option>
											<?php foreach ($angkatan as $key => $value) { ?>
													<option value="{{ $value->id }}">{{ $value->angkatan }}</option>	
											<?php } ?>										
											</select>
										</div>
									</div>	
									<div class="form-group mb-0 row">
										<div class="col-lg-3">
											<label>Jurusan</label>
										</div>
										<div class="col-lg-9">
											<select class="js-example-basic-single w-100" name="jurusan" required>
												<option>Select Jurusan</option>
											<?php foreach ($jurusan as $key => $value) { ?>
													<option value="{{ $value->id }}">{{ $value->jurusan }}</option>	
											<?php } ?>										
											</select>
										</div>
									</div><br>
									<div class="form-group mb-0 row">
										<div class="col-lg-3">											
										</div>
										<div class="col-lg-9">
											<button type="submit" class="btn btn-primary">Submit</button>
											<a href="{{ route('admin.master.mhs') }}"><button type="button" class="btn btn-light">Cancel</button></a>
										</div>
									</div>										
								</form>															
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection