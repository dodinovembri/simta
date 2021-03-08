@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mhs.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Perpanjang Kompre</li>
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

                <?php if (empty($mhs)) { ?>
                  <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_perpanjang_kompre')}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <fieldset>
                    <div class="form-group">
                       <label>File Konsultasi</label>                      
                         <input type="file" name="file_konsultasi" class="file-upload-default">
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
                <?php } elseif ($mhs->id_status_agree_perpanjang == 1) { ?>
                    <div class="alert alert-dismissible alert-fill-success" role="alert">
                      Menunggu konfirmasi dosen pembimbing skripsi terkait perpanjang sempro
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <?php } elseif ($mhs->id_status_agree_perpanjang == 2) { ?>
                    <div class="alert alert-dismissible alert-fill-success" role="alert">
                      Perpanjang sempro anda disetujui oleh pembimbing skripsi
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <?php } elseif ($mhs->id_status_agree_perpanjang == 3) { ?>
                    <div class="alert alert-dismissible alert-fill-success" role="alert">
                      Perpanjang sempro anda ditolak oleh pembimbing skripsi, silahkan melakukan konsultasi lagi
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-dismissible alert-fill-success" role="alert">
                      Silahkan hubungi administrator
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <?php } ?>                                                                
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection