<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ CNF_APPNAME }}</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{ asset('fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/maps/jquery-jvectormap-2.0.3.css') }}" />
    <link href="{{ asset('css/icheck/flat/green.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/floatexamples.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />

    <!-- table -->
    <link href="{{ asset('js/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/toastr/toastr.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('crop/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Autocomplete Dropdown -->
    <link href="{{ asset('css/select/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- calender -->
    <link href="{{ asset('css/calendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar/fullcalendar.print.css') }}" rel="stylesheet" media="print">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/nprogress.js') }}"></script>

    <script src="{{ asset('crop/cropper.min.js') }}"></script>
    

</head>


<body class="nav-md">

<div class="container body">

    <div class="main_container">
        @include('layouts/sidemenu')
        @include('layouts/headmenu')
        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 917px;">
            @yield('content')
        </div>
        <!-- end content -->
        @include('layouts/footer')
    </div>
</div>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- bootstrap progress js -->
<script src="{{ asset('js/progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- icheck -->
<script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('js/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datepicker/daterangepicker.js') }}"></script>
<!-- chart js -->
<script src="{{ asset('js/chartjs/chart.min.js') }}"></script>

<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/validator/validator.js')}}"></script>
<!-- form validation -->
<script type="text/javascript" src="{{ asset('js/parsley/parsley.min.js') }}"></script>
<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="{{ asset('js/excanvas.min.js') }}"></script><![endif]-->
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.orderBars.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.time.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/date.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.spline.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.stack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/curvedLines.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/flot/jquery.flot.resize.js') }}"></script>
<!-- worldmap -->
<script type="text/javascript" src="{{ asset('js/maps/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/maps/gdp-data.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/maps/jquery-jvectormap-us-aea-en.js') }}"></script>
<!-- Datatables-->
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('js/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('js/calendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/datetimepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery.jCombo.min.js') }}"></script>
<script src="{{ asset('js/select/select2.full.js') }}"></script>
<!-- pace -->
<script src="{{ asset('js/pace/pace.min.js') }}"></script>
<!-- skycons -->
<script src="{{ asset('js/skycons/skycons.min.js') }}"></script>

<!-- AJax -->
<link href="{{ asset('js/ajax/ajaxSximo.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/ajax/ajaxSximo.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/toastr/toastr.js') }}"></script>
{{ \Sitehelpers::showNotification() }}
@yield('js_section');

</body>

</html>
