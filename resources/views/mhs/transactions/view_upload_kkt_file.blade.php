@extends('layouts.mhs_dashboard')

@section('content')

			<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">			
            			<li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>								
						<li class="breadcrumb-item active" aria-current="page">Upload KKT File</li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
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

								<h4 class="card-title">Form Upload data KP, KRS dan Transkrip Nilai</h4>								    

								<form class="cmxform" id="signupForm" method="post" action="{{ route('mhs.transactions.store_kkt_file') }}" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">	
									<fieldset>
										<div class="form-group">
										
											<?php if (empty($kkt_file) || $mhs->status_kkt_file == 0) {
												# code... ?>
												<div class="form-group">												
													<label>KP File <span class="text-danger">*</span></label> 									
													<input type="file" name="kp_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">												
													<label>KRS File <span class="text-danger">*</span></label> 									
													<input type="file" name="krs_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">												
													<label>Transkrip File <span class="text-danger">*</span></label> 									
													<input type="file" name="transkrip_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">
													<label for="jumlah_sks_tempuh">Jumlah SKS Tempuh <span class="text-danger">*</span></label>
													<input id="jumlah_sks_tempuh" class="form-control" name="jumlah_sks_tempuh" type="number" min="0" required>
												</div>																						
												<div class="form-group">
													<label for="jumlah_sks_transkrip">Jumlah SKS Transkrip <span class="text-danger">*</span></label>
													<input id="jumlah_sks_transkrip" class="form-control" name="jumlah_sks_transkrip" type="number" min="0" required>
												</div><br>		
												<div class="form-group">
													<input class="btn btn-primary" type="submit" value="Submit">	
												</div>	
												

											<?php } else{
												if ($mhs->status_kkt_file == 1) {
													# code... ?>
								                   <div class="alert alert-dismissible alert-fill-info" role="alert">
								                      Anda sudah mengupload KKT File, Tetatpi belum di verifikasi oleh admin
								                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								                       <span aria-hidden="true">&times;</span>
								                    </button>
								                   </div>
										          	<div class="form-group">
													<div class="table-responsive">
														<table class="table">
										          		<thead>
										          			<td>KP File</td>
										          			<td>KRS File</td>
										          			<td>Transkrip File</td>
										          			<td>SKS Sekarang</td>
										          			<td>SKS Transkrip</td>
										          		</thead>
										          		<tr>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>													<a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>{{ $kkt_file->jumlah_sks_tempuh }}</td>
										          			<td>{{ $kkt_file->jumlah_sks_transkrip }}</td>
										          		</tr>
										          	</table>												
										          	</div>
													</div>								                   
												<?php }elseif ($mhs->status_kkt_file == 2) {
													# code... ?>
													<div class="alert alert-fill-warning" role="alert">
										            Anda sudah mengupload KKT File dan sudah di verifikasi oleh admin
										          	</div>		
										          	<div class="form-group">
													<div class="table-responsive">
														<table class="table">
										          		<thead>
										          			<td>KP File</td>
										          			<td>KRS File</td>
										          			<td>Transkrip File</td>
										          			<td>SKS Sekarang</td>
										          			<td>SKS Transkrip</td>
										          		</thead>
										          		<tr>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>													<a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>{{ $kkt_file->jumlah_sks_tempuh }}</td>
										          			<td>{{ $kkt_file->jumlah_sks_transkrip }}</td>
										          		</tr>
										          	</table>												
										          	</div>
													</div>											
												<?php } elseif ($mhs->status_kkt_file == 3) {
													# code... ?>
													<div class="alert alert-fill-warning" role="alert">
										            Hasil verifikasi tidak sesuai, silahkan cek kembali data yang di input dan ulangi kembali proses pengajuan
										          	</div>
													<div class="table-responsive">
														<table class="table">
										          		<thead>
										          			<td>KP File</td>
										          			<td>KRS File</td>
										          			<td>Transkrip File</td>
										          			<td>SKS Sekarang</td>
										          			<td>SKS Transkrip</td>										          			
										          		</thead>
										          		<tr>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td><a href="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->krs_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>													<a href="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $kkt_file->transkrip_file }}" class="img-fluid" alt="profile cover"></a></td>
										          			<td>{{ $kkt_file->jumlah_sks_tempuh }}</td>
										          			<td>{{ $kkt_file->jumlah_sks_transkrip }}</td>										          			
										          		</tr>
										          	</table>
										          	</div>
													<div class="form-group">												
													<label>KP File <span class="text-danger">*</span></label> 									
													<input type="file" name="kp_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">												
													<label>KRS File <span class="text-danger">*</span></label> 									
													<input type="file" name="krs_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">												
													<label>Transkrip File <span class="text-danger">*</span></label> 									
													<input type="file" name="transkrip_file" class="file-upload-default" accept='image/*'>
													<div class="input-group col-xs-12">
														<input type="text" class="form-control file-upload-info" placeholder="Upload Image" required="">
														<span class="input-group-append">
															<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
														</span>
													</div>
												</div>
												<div class="form-group">
													<label for="jumlah_sks_tempuh">Jumlah SKS Tempuh <span class="text-danger">*</span></label>
													<input id="jumlah_sks_tempuh" class="form-control" name="jumlah_sks_tempuh" type="number" min="0" required>
												</div>																						
												<div class="form-group">
													<label for="jumlah_sks_transkrip">Jumlah SKS Transkrip <span class="text-danger">*</span></label>
													<input id="jumlah_sks_transkrip" class="form-control" name="jumlah_sks_transkrip" type="number" min="0" required>
												</div><br>		
												<div class="form-group">
													<input class="btn btn-primary" type="submit" value="Submit">	
												</div>										          	
												<?php }
											} ?>
												
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
@endsection