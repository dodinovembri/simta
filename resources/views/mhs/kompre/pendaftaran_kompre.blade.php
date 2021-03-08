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
                <?php if (empty($pendaftaran_kompre)) {               
                    if (isset($is_sempro)) { ?>
                          <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_pendaftaran_kompre')}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <fieldset>
                              <div class="form-group">                      
                              </div>                              
                               <a href="#" data-toggle="modal" data-target="#exampleModal"><input class="btn btn-primary" type="submit" value="Daftar Kompre"></a>
                            </fieldset> <br>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Register Kompre</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure to register Kompre ?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal -->
                          </form>                    
                      <?php } else{ ?>
                        <div class="alert alert-danger" role="alert">Anda belum sempro</div>
                      <?php }                    
                  ?>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 0) { ?>
                  <div class="alert alert-primary" role="alert">
                    Anda Belum Melakukan Pendaftaran
                  </div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 1) { ?>
                  <div class="alert alert-secondary" role="alert">Menunggu Verifikasi Admin</div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 2) { ?>
                  <div class="alert alert-success" role="alert">Data anda sudah diverifikasi admin, silahkan menunggu jadwal sempro</div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 3) { ?>
                  <div class="alert alert-danger" role="alert">Data yang anda masukkan tidak lengkap, silahkan lengkapi dan daftar lagi</div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 4) { ?>
                  <div class="alert alert-success" role="alert">Jadwal dan Penguji anda sudah di atur</div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 5) { ?>
                  <div class="alert alert-success" role="alert">Anda sudah kompre</div>
                <?php } elseif ($pendaftaran_kompre->id_status_ta_2 == 6) { ?>
                  <div class="alert alert-success" role="alert">Anda gagal dalam kompre ini, slahkan mencoba lagi</div>
                <?php } else{ ?>
                    <div class="alert alert-success" role="alert">Silahkan hubungi administrator</div>
                <?php } ?>
<!-- 
                <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_topik')}}">
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
                </form> -->
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection