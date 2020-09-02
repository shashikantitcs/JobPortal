
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.css') }}">
  {{-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/css/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">  
   <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.min.css') }}">

  <!-- endinject -->

   {{-- <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" /> --}}
   <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/tempusdominus-bootstrap-4.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css"> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}"> --}}

  </head>
<body class="sidebar-fixed">

@section('body')
@show

  <!-- container-scroller -->


  <!-- base:js -->
  <script src="{{ asset('assets/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
   <script src="{{ asset('assets/js/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.resize.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.vmap.usa.js') }}"></script>--}}
  <script src="{{ asset('assets/js/jquery.peity.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.flot.dashes.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->

<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>



  <script src="{{ asset('assets/js/jquery.avgrund.min.js') }}"></script>
  <!-- End plugin js for this page -->

  <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/alerts.js') }}"></script>
  <script src="{{ asset('assets/js/avgrund.js') }}"></script>
  <script src="{{ asset('assets/js/parsley.js') }}"></script>
  <script src="{{ asset('assets/js/encription.js') }}"></script>
  
  <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>  
  <script type="text/javascript" src="{{ asset('assets/js/tempusdominus-bootstrap-4.js') }}"></script>

  <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
  @section('calendar')
  @show
 
  <script type="text/javascript" src="{{ asset('assets/js/dynamic-form.js') }}"></script>

  {{-- <script type="text/javascript" src="{{ asset('assets/js/vendordropzone.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/js/file-upload.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/main.js') }}">

  </script>

  <script>
     $('.reset-captcha').click(function(){
      $.ajax({
        url: "{{ route('captcha.refresh') }}",
        cache: false,
        success: function(html){
          $(".captchaImg").attr("src", html);
        }
      });
    });
  </script>

</body>

</html>
