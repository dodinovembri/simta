@extends('layouts.admin_dashboard')

@section('content')
			<div class="page-content">
				<div class="row">

					<div class="col-xl-10 col-sm-4 main-content pl-xl-4 pr-xl-5">						
						<h4 id="kp">Total SKS</h4>
						<div class="example">
							{{$mhs->total_sks}}
						</div>
						<hr>
						<h4 id="kp">KP File</h4>
						<div class="example">
							<a href="{{ asset('assets/images') }}/{{ $mhs['kp_file'] }}" target="_blank"><img src="{{ asset('assets/images') }}/{{ $mhs['kp_file'] }}" class="img-fluid" alt="profile cover"></a>
						</div>
						<hr>
						<h4 id="krs">KRS File</h4>
						<div class="example">
							<a href="{{ asset('assets/images') }}/{{ $mhs['krs_file'] }}" target="_blank"><img src="{{ asset('assets/images') }}/{{ $mhs['krs_file'] }}" class="img-fluid" alt="profile cover"></a>
						</div>
						<hr>
						<h4 id="transkrip">Transkrip Nilai</h4>
						<div class="example">
							<a href="{{ asset('assets/images') }}/{{ $mhs['transkrip_file'] }}" target="_blank"><img src="{{ asset('assets/images') }}/{{ $mhs['transkrip_file'] }}" class="img-fluid" alt="profile cover"></a>
						</div>						
					</div>
					<form action="{{ route('admin.transactions.store_verifikasi_data_mhs_detail', $mhs['nim']) }}" method="POST">	
                  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-xl-2 col-2 pl-xl-4 pr-xl-4 content-nav-wrapper">
							<div class="form-group">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" name="kp_file" class="form-check-input">
										KP File
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" name="krs_file" class="form-check-input">
										KRS File
									</label>
								</div>	
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" name="transkrip_file" class="form-check-input">
										Transkrip Nilai
									</label>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Notes <span class="text-danger">*</span></label>
									<textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="5" required="">{{ $mhs['ket'] }}</textarea>
								</div>	
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
@endsection