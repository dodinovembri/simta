@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('mhs') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Mahasiswa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Transactions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Topik TA</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="#">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <fieldset>
                    <div class="form-group">
                       <label>Status Kompre</label>                      
                         
                     </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection