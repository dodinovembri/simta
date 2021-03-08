@extends('layouts.dosen_dashboard')

@section('content')
			<div class="page-content">
				<div class="row">

					<div class="col-xl-10 col-sm-4 main-content pl-xl-4 pr-xl-5">										
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
		                @if(!empty($detail_sempro['file_perpanjang']))
		                <h4 id="kp">Judul TA</h4>
							<div class="example">
								{{$detail_sempro->judul_ta}}
							</div>
							<hr>		
		                <h4 id="kp">File Konsultasi</h4>
							<div class="example">
								<a href="{{ asset('assets/images') }}/{{ $detail_sempro['file_perpanjang'] }}" target="_blank"><img src="{{ asset('assets/images') }}/{{ $detail_sempro['file_perpanjang'] }}" class="img-fluid" alt="profile cover"></a>
							</div>
							<hr>		
						@endif							
					</div>
					<form action="{{ route('dosen.transactions.approved_sempro_mhs', $detail_sempro['id']) }}" method="POST">	
                  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-xl-2 col-2 pl-xl-4 pr-xl-4 content-nav-wrapper">
							<div class="form-group">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="status_approve_ta" id="status-approve-ta" value="2" {{$detail_sempro['id_status_agree_perpanjang'] == 1 ? 'checked': ''}}>
											Setuju
										<i class="input-frame"></i></label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="status_approve_ta" id="status-approve-ta1" value="3" {{$detail_sempro['id_status_agree_perpanjang'] == 2 ? 'checked': ''}}>
											Tidak Setuju
										<i class="input-frame"></i></label>
									</div>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Notes <span class="text-danger">*</span></label>
									<textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="5">{{ $detail_sempro['ket'] }}</textarea>
								</div>	
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
@endsection