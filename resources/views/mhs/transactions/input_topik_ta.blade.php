@extends('layouts.mhs_dashboard')

@section('content')
      <div class="page-content">

        <nav class="page-breadcrumb">
          <ol class="breadcrumb">     
                  <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>               
            <li class="breadcrumb-item active" aria-current="page">Input Topik TA</li>
          </ol>
        </nav>

        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Form Input Topik TA</h4>                
                <form class="cmxform" id="signupForm" method="get" action="#">
                  <fieldset>
                    <div class="form-group mb-0 row">
                      <div class="col-lg-3">
                        <label>Angkatan</label>
                      </div>
                      <div class="col-lg-8">
                        <select class="js-example-basic-single w-100" name="angkatan">
                        <?php foreach ($topik_ta as $key => $value) { ?>
                            <option value="{{ $value->id }}">{{ $value->angkatan }}</option>  
                        <?php } ?>                    
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>KRS File</label> 
                      <input type="file" name="krs_file" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Transkrip File</label> 
                      <input type="file" name="transkrip_file" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>                                        
                    <div class="form-group">
                      <label for="jumlah_sks_tempuh">Jumlah SKS Tempuh</label>
                      <input id="jumlah_sks_tempuh" class="form-control" name="jumlah_sks_tempuh" type="number" min="0" required>
                    </div>
                    <div class="form-group">
                      <label for="jumlah_sks_transkrip">Jumlah SKS Transkrip</label>
                      <input id="jumlah_sks_transkrip" class="form-control" name="jumlah_sks_transkrip" type="number" min="0" required>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Submit">
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection