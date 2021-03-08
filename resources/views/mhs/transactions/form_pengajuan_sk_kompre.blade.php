@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('mhs') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Mahasiswa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Transactions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Pengajuan SK Kompre</li>
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
                  <?php if (empty($cek)) { ?>
                      <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_perpanjang_sk_kompre')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <fieldset>
                          <div class="form-group">
                             <label>SK Kompre</label>                      
                               <input type="file" name="sk_kompre" class="file-upload-default">
                               <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload File">
                                  <span class="input-group-append">
                                     <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                               </div>
                               <small class="text-danger">File yang diterima hanya berekstensi .xls, .xlsx, .pdf, .jpeg, .jpg, .png dan ukuran maks. 10 MB</small>
                           </div>
                           <br>
                              <input class="btn btn-primary" type="submit" value="Submit">
                        </fieldset>
                      </form>                    
                  <?php } else{ ?>
                      <div class="alert alert-info" role="alert">Anda sudah mengajukan sk kompre</div>
                  <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection