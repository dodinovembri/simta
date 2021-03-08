@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('mhs') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pendaftaran Sempro</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Form Pendaftaran Sempro</h6>   

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
                <?php if (empty($pendaftaran_sempro)) { ?>
                  <form class="cmxform" id="signupForm" method="POST" enctype="multipart/form-data" action="{{route('mhs.transactions.store_mhs_pendaftaran_sempro')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <fieldset>
                      <div class="form-group">                      
                      </div>
                       <br>
                       @if (empty($pendaftaran_sempro))
                          @if ($mhs_topik_ta->id_status_agree_topik == 2)
                          <a href="#" data-toggle="modal" data-target="#exampleModal"><input class="btn btn-primary" type="submit" value="Daftar Sempro"></a>
                          @endif
                       @else
                          <div class="alert alert-dismissible alert-fill-success" role="alert">                      
                            Anda sudah mengajukan Pendaftaran Sempro
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                       @endif
                        <br>
                        <br>
                    </fieldset>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Sempro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to register sempro ?
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
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 0) { ?>
                  <div class="alert alert-primary" role="alert">
                    Anda Belum Melakukan Pendaftaran
                  </div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 1) { ?>
                  <div class="alert alert-secondary" role="alert">Menunggu Verifikasi Admin</div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 2) { ?>
                  <div class="alert alert-success" role="alert">Data anda sudah diverifikasi admin, silahkan menunggu jadwal sempro</div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 3) { ?>
                  <div class="alert alert-danger" role="alert">Data yang anda masukkan tidak lengkap, silahkan lengkapi dan daftar lagi</div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 4) { ?>
                  <div class="alert alert-success" role="alert">Penguji anda sudah di atur</div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 5) { ?>
                  <div class="alert alert-success" role="alert">Anda sudah sempro</div>
                <?php } elseif ($pendaftaran_sempro->id_status_ta_1 == 6) { ?>
                  <div class="alert alert-success" role="alert">Anda gagal dalam sempro ini, slahkan mencoba lagi</div>
                <?php }  elseif ($pendaftaran_sempro->id_status_ta_1 == 7) { ?>
                  <div class="alert alert-success" role="alert">Jadwal Anda Sudah di Atur, Silahkan Liat Jadwal</div>
                <?php } else{ ?>                  
                    <div class="alert alert-success" role="alert">Silahkan hubungi administrator</div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection