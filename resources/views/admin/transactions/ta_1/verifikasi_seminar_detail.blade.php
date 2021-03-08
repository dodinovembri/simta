@extends('layouts.admin_dashboard')

@section('content')
<div class="page-content">

    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Verifikasi Syarat Sempro</li>
      </ol>
    </nav>
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Syarat Sempro</h6>
						NIM : {{ $mhs->nim }}<br>
						Nama : {{ $mhs->nama }}<br><br>
						<form method="POST" action="{{ route('admin.transactions.store_syarat_ta_1_mhs') }}">
                  			<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  			<input type="hidden" name="nim" value="{{ $mhs->nim }}">
							<div class="form-group">
								<?php foreach ($syarat_ta_1 as $key => $value) { ?>
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="syarat_ta_1[]" value="{{ $value->file_name }}">
											{{ $value->file_name }}
										</label>
									</div>
								<?php } ?>
							</div><br>
							<?php if (count($syarat_ta_1) > 0) { ?>
								<button class="btn btn-primary" type="submit">Submit</button>
							<?php } ?>							
						</form>
					</div>
				</div>
			</div>
		</div>
</div>

@endsection				