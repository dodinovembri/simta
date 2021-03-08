<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SIMTA SI UNSRI</title>
  <!-- core:css -->
  <link rel="stylesheet" href="{{ asset('tmp/assets/vendors/core/core.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('tmp/assets/fonts/feather-font/css/iconfont.css') }}">
  <!-- endinject -->
  <!-- Layout styles -->  
  <link rel="stylesheet" href="{{ asset('tmp/assets/css/demo_1/style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('assets/logo/logo.png') }}" />
</head>
<body>
<body>
      @yield('content')

  <!-- core:js -->
  <script src="{{ asset('tmp/assets/vendors/core/core.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('tmp/assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('tmp/assets/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <!-- end custom js for this page -->
</body>
</html>