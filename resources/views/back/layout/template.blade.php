<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>       
    <!-- App css -->

        <link href="{{asset('Admin/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- icons -->
        <link href="{{asset('Admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        @stack('css')
</head>
<body>
    <div id="wrapper">
    @yield('content')
    </div>
   <!-- Vendor -->
   <script src="{{asset('Admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('Admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('Admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('Admin/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('Admin/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('Admin/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('Admin/libs/feather-icons/feather.min.js')}}"></script>

        <!-- knob plugin -->
        <script src="{{asset('Admin/libs/jquery-knob/jquery.knob.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{asset('Admin/libs/morris.js06/morris.min.js')}}"></script>
        <script src="{{asset('Admin/libs/raphael/raphael.min.js')}}"></script>
  
        <!-- Dashboar init js-->
        <script src="{{asset('Admin/js/pages/dashboard.init.js')}}"></script>

        <!-- App js-->
        <script src="{{asset('Admin/js/app.min.js')}}"></script>
        @stack('js')
</body>
</html>