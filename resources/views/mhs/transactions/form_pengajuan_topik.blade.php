@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mhs.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Topik TA</li>
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

                <h4 class="card-title">Form Pengajuan Topik TA</h4>
                <?php if ($mhs->status_kkt_file != 2) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                      Anda belum bisa mengajukan topik ta, silahkan lengkapi KKT file atau klik  <a href="{{route('mhs.view_upload_kkt_file')}}" style="text-decoration: underline">disini</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                   </div>
                <?php } else{ ?>
                  <?php if (count($data_ta) > 0) { ?>
                      <div class="alert alert-dismissible alert-fill-info" role="alert">
                          Anda sudah mengajukan topik TA. Jika ingin melakukan perubahan topik TA klik <a href="{{route('mhs.transactions.form_perubahan_topik')}}" style="text-decoration: underline">disini</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  <?php } else{ ?>                  
                      <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_topik')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <fieldset>
                          <div class="form-group">
                              <label>Calon Pembimbing I</label>
                            <div class="input-group col-xs-12">
                              <select class="js-example-basic-single w-100" name="dosen[]">
                                <option disabled>Pilih Dosen</option>
                                 <?php foreach ($dosen as $key => $value) { ?>
                                    <option value="{{ $value->nip }}">{{ $value->nama }}</option>
                                 <?php } ?>
                              </select>
                            </div>
                          </div>  
                          <div class="form-group">
                              <label>Calon Pembimbing II</label>
                            <div class="input-group col-xs-12">
                              <select class="js-example-basic-single w-100" name="dosen[]">
                                <option disabled>Pilih Dosen</option>
                                 <?php foreach ($dosen as $key => $value) { ?>
                                    <option value="{{ $value->nip }}">{{ $value->nama }}</option>
                                 <?php } ?>
                              </select>
                            </div>
                          </div>                                                    
                          <div class="form-group">
                              <label>Topik TA</label>
                            <div class="input-group col-xs-12">
                              <select class="js-example-basic-single w-100" name="id_topik_ta">
                                <option disabled>Pilih Topik TA</option>
                                 <?php foreach ($topik_ta as $key => $value) { ?>
                                    <option value="{{ $value->id }}">{{ $value->topik_ta }}</option>
                                 <?php } ?>
                              </select>
                            </div>
                          </div>
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

                          <div class="form-group">
                            <label for="judul_ta">Judul TA</label>
                              <input id="judul_ta" class="form-control" name="judul_ta" type="text" value="">
                          </div>                          
                          <input class="btn btn-primary" type="submit" value="Submit">                          
                        </fieldset>
                      </form> 
                    <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection