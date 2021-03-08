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
		                <h4 id="jt">Judul TA</h4>
		                @if(!empty($topik_ta_mhs['judul_ta']))
							<div class="example">
								{{ $topik_ta_mhs['judul_ta'] }}
							</div>
							<hr>		
						@endif	
						<h4 id="kp">File Konsultasi</h4>

		                @if(!empty($topik_ta_mhs['file_konsultasi']))
							<div class="example">
								<a href="{{ asset('assets/images') }}/{{ $topik_ta_mhs['file_konsultasi'] }}" target="_blank"><img src="{{ asset('assets/images') }}/{{ $topik_ta_mhs['file_konsultasi'] }}" class="img-fluid" alt="File Konsultasi"></a>
							</div>
							<hr>		
						@endif							
					</div>
					<form action="{{ route('dosen.transactions.approved_topik_ta_mhs', $topik_ta_mhs['id']) }}" method="POST">	
                  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-xl-2 col-2 pl-xl-4 pr-xl-4 content-nav-wrapper">
							<div class="form-group">
								<div class="form-group">
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="status_approve_ta" id="status-approve-ta" value="2" {{$topik_ta_mhs['id_status_agree_topik'] == 2 ? 'checked': ''}}>
											Setuju
										<i class="input-frame"></i></label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="status_approve_ta" id="status-approve-ta1" value="3" {{$topik_ta_mhs['id_status_agree_topik'] == 3 ? 'checked': ''}}>
											Tidak Setuju
										<i class="input-frame"></i></label>
									</div>
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Notes <span class="text-danger">*</span></label>
									<textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="5">{{ $topik_ta_mhs['ket'] }}</textarea>
								</div>	
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
@endsection