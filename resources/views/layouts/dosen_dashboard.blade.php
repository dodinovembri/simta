<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dosen SIMTA SI</title>
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/core/core.css') }}">
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">    
  <link rel="stylesheet" href="{{ asset('tmp/assets/fonts/feather-font/css/iconfont.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/css/demo_1/style.css') }}">  
  <link rel="shortcut icon" href="{{ asset('assets/logo/logo.png') }}" />
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/select2/select2.min.css') }}">
<!--   <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/dropzone/dropzone.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/dropify/dist/dropify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"> -->
    
</head>
<body>
  <div class="main-wrapper">
    @include('template.dosen_template.sidebar')         
    <div class="page-wrapper">
      @include('template.dosen_template.header')
      @yield('content')
      @include('template.dosen_template.footer')
    </div>
  </div>  

  <script src="{{ asset('tmp/assets/vendors/core/core.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/vendors/chartjs/Chart.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/jquery.flot/jquery.flot.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/vendors/apexcharts/apexcharts.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/progressbar.js/progressbar.min.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/template.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/datepicker.js') }}"></script>

  <!-- end inject template -->
  <script src="{{ asset('tmp/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>  
  <script src="{{ asset('tmp/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>  
  <script src="{{ asset('tmp/assets/js/data-table.js' )}}"></script>
  <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
  
  <script src="{{ asset('tmp/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('tmp/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('tmp/assets/vendors/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('tmp/assets/vendors/select2/select2.min.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/dropzone/dropzone.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/dropify/dist/dropify.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/vendors/moment/moment.min.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/bootstrap-maxlength.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/js/inputmask.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/js/select2.js') }}"></script>
  <!-- <script src="{{ asset('tmp/assets/js/typeahead.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/js/tags-input.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/js/dropzone.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/js/dropify.js') }}"></script> -->
  <!-- <script src="{{ asset('tmp/assets/js/bootstrap-colorpicker.js') }}"></script> -->
  <script src="{{ asset('tmp/assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/timepicker.js') }}"></script>
  <!-- end custom js for this page -->
  <script src="{{ asset('tmp/assets/js/file-upload.js') }}"></script>

</body>
</html>    