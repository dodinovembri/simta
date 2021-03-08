@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">     
            <li class="breadcrumb-item"><a href="{{ route('mhs.dashboard') }}">Dashboard</a></li>                           
            <li class="breadcrumb-item active" aria-current="page">Perubahan Topik TA</li>
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

                <h4 class="card-title">Form Perubahan Topik TA</h4>   
                <?php if (!isset($mhs_topik_ta)) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Anda belum mengajukan topik TA, silahkan ajukan terlebih dahulu                      
                  </div>
                <?php } elseif ($mhs_topik_ta->id_status_agree_topik == 1) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Menunggu konfirmasi pembimbing akademik terkait topik yang anda ajukan
                  </div>
                <?php } elseif ($mhs_topik_ta->id_status_agree_topik == 2 && $diff_day < 30) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Topik TA anda disetujui, silahkan ajukan sempro! sisa batas waktu anda {{ $sisa }} hari
                  </div>
                <?php } elseif ($mhs_topik_ta->id_status_agree_topik == 2 && $diff_day >= 30) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Waktu pengajuan sempro anda sudah habis, silahkan lakukan perubahan topik TA dibawah ini
                  </div>                  
                  <form class="cmxform" id="ubah-topik" method="post" action="{{ route('mhs.transactions.update_perubahan_topik') }}" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                      <fieldset>
                        <div class="form-group">
                          <label for="judul_ta">Topik TA</label>
                            <select class="js-example-basic-single w-100" name="id_topik_ta">
                              <option>Pilih Topik TA</option>

                            <?php foreach ($topik_ta as $key => $value) { ?>
                                @if($mhs_topik_ta->id_topik_ta == $value->id)
                                  <option value="{{ $value->id }}" selected="">{{ $value->topik_ta }}</option>
                                @else 
                                  <option value="{{ $value->id }}">{{ $value->topik_ta }}</option>
                                @endif
                            <?php } ?>                    
                            </select>                      
                        </div> 
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
                          <label for="judul_ta">Judul TA</label>                          
                            <input id="judul_ta" class="form-control" name="judul_ta" type="text" required value="{{ $mhs_topik_ta->judul_ta }}" >                          
                        </div>

                        <div class="form-group">
                          <label for="judul_ta">Status</label>
                          <br />
                          @if($mhs_topik_ta->id_status_agree_topik == 1)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Waiting Acc</b>
                          @elseif($mhs_topik_ta->id_status_agree_topik == 2)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Di setujui</b>
                          @elseif($mhs_topik_ta->id_status_agree_topik == 3)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Tidak di setujui</b>
                          @endif
                          <br />
                        </div>

                        <div class="form-group">
                          <label>File Konsultasi</label> 
                          <small class="text-danger">File yang diterima hanya berekstensi .xls, .xlsx, .pdf, .jpeg, .jpg, .png dan ukuran maks. 10 MB</small>
                          @if($mhs_topik_ta->id_status_agree_topik != 2)
                            <input type="file" name="file_konsultasi" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload File">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                          @endif

                          @if(!empty($mhs_topik_ta->file_konsultasi))
                            @if(\File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == 
                            "application/vnd.ms-office" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == 
                            "application/pdf" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                              <br />
                              <div class="example">
                                <a href="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" target="_blank" class="btn btn-success text-white">Download disini</a>
                              </div>


                            @elseif(\File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/jpeg" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/png" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/jpg")
                              <br />
                              <div class="example">
                                <a href="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" class="img-fluid" alt="profile cover"></a>
                              </div>
                            @endif
                          @endif
                        </div>

                        @if($mhs_topik_ta->ket)
                          <br />
                          <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" readonly="" name="notes" rows="5" required="">{{ $mhs_topik_ta->ket }}</textarea>
                          </div>  
                        @endif                                            
                          <input class="btn btn-primary" type="submit" value="Submit">
                      </fieldset>
                    </form>              
                <?php } elseif ($mhs_topik_ta->id_status_agree_topik == 3) { ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Maaf, topik TA anda tidak disetujui, silahkan konsultasi dan lakukan perubahan topik dibawah ini
                  </div><br>
                  <form class="cmxform" id="ubah-topik" method="post" action="{{ route('mhs.transactions.update_perubahan_topik') }}" enctype="multipart/form-data">
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
                          <label for="judul_ta">Topik TA</label>
                            <select class="js-example-basic-single w-100" name="id_topik_ta">
                              <option>Pilih Topik TA</option>

                            <?php foreach ($topik_ta as $key => $value) { ?>
                                @if($mhs_topik_ta->id_topik_ta == $value->id)
                                  <option value="{{ $value->id }}" selected="">{{ $value->topik_ta }}</option>
                                @else 
                                  <option value="{{ $value->id }}">{{ $value->topik_ta }}</option>
                                @endif
                            <?php } ?>                    
                            </select>                      
                        </div>                    
                        <div class="form-group">
                          <label for="judul_ta">Judul TA</label>                          
                            <input id="judul_ta" class="form-control" name="judul_ta" type="text" required value="{{ $mhs_topik_ta->judul_ta }}" >                          
                        </div>

                        <div class="form-group">
                          <label for="judul_ta">Status</label>
                          <br />
                          @if($mhs_topik_ta->id_status_agree_topik == 1)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Waiting Acc</b>
                          @elseif($mhs_topik_ta->id_status_agree_topik == 2)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Di setujui</b>
                          @elseif($mhs_topik_ta->id_status_agree_topik == 3)
                            <input id="judul_ta" class="form-control" name="id_status_agree_topik" type="hidden" required value="{{ $mhs_topik_ta->id_status_agree_topik }}">
                            <b>Tidak di setujui</b>
                          @endif
                          <br />
                        </div>

                        <div class="form-group">
                          <label>File Konsultasi</label> 
                          <small class="text-danger">File yang diterima hanya berekstensi .xls, .xlsx, .pdf, .jpeg, .jpg, .png dan ukuran maks. 10 MB</small>
                          @if($mhs_topik_ta->id_status_agree_topik != 2)
                            <input type="file" name="file_konsultasi" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload File">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                          @endif

                          @if(!empty($mhs_topik_ta->file_konsultasi))
                            @if(\File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == 
                            "application/vnd.ms-office" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == 
                            "application/pdf" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                              <br />
                              <div class="example">
                                <a href="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" target="_blank" class="btn btn-success text-white">Download disini</a>
                              </div>


                            @elseif(\File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/jpeg" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/png" || \File::mimeType('./assets/images/' . $mhs_topik_ta->file_konsultasi) == "image/jpg")
                              <br />
                              <div class="example">
                                <a href="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" target="_blank"><img width="200px" height="200px" src="{{ asset('assets/images') }}/{{ $mhs_topik_ta->file_konsultasi }}" class="img-fluid" alt="profile cover"></a>
                              </div>
                            @endif
                          @endif
                        </div>

                        @if($mhs_topik_ta->ket)
                          <br />
                          <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" readonly="" name="notes" rows="5" required="">{{ $mhs_topik_ta->ket }}</textarea>
                          </div>  
                        @endif                                            
                          <input class="btn btn-primary" type="submit" value="Submit">
                      </fieldset>
                    </form>                   
                <?php } else{ ?>
                  <div class="alert alert-dismissible alert-fill-info" role="alert">
                    Silahkan hubungi administrator!
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection