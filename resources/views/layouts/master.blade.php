<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} </title>
    <link rel="shortcut icon" href="{{ asset('dashboard/images/logo-favicon.png') }}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/morris/morris.css ') }}">

    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css ">
    <link href="{{ asset('dashboard/css/icons.css') }}" rel="stylesheet" type="text/css ">
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet" type="text/css ">

    <!-- DataTables -->
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->

    <link href="{{ asset('dashboard/css/jquery-ui.css') }}" rel="stylesheet" type="text/css ">

    <!--calendar css-->
    <link href="{{ asset('dashboard/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- select2-bootstrap4-theme -->
    <link href="https://rawcdn.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.min.css" rel="stylesheet">

    @livewireStyles

</head>

<body class="fixed-left">

    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">
        @include('layouts.partials._sidebar')

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                @include('layouts.partials._nav')

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        @yield('container')

                    </div><!-- container fluid -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            @include('layouts/partials/_footer')

        </div>
        <!-- End Right content here -->

    </div>


    @yield('js')

    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js ') }}"></script>
    <script src="{{ asset('dashboard/js/modernizr.min.js ') }}"></script>
    <script src="{{ asset('dashboard/js/detect.js ') }}"></script>
    <script src="{{ asset('dashboard/js/fastclick.js ') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.slimscroll.js ') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.blockUI.js ') }}"></script>
    <script src="{{ asset('dashboard/js/waves.js ') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.nicescroll.js ') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.scrollTo.min.js ') }}"></script>

    <!-- skycons -->
    <script src="{{ asset('dashboard/plugins/skycons/skycons.min.js ') }}"></script>

    <!-- skycons -->
    <script src="{{ asset('dashboard/plugins/peity/jquery.peity.min.js ') }}"></script>

    <!-- App js -->
    <script src="{{ asset('dashboard/js/app-drixo.js ') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js ') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js ') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js ') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js ') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/pages/datatables.init.js ') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function() {
            $('select').each(function() {
                $(this).select2({
                    theme: 'bootstrap4'
                    , width: '100%'
                    , placeholder: $(this).attr('placeholder')
                    , allowClear: Boolean($(this).data('allow-clear'))
                , });
            });
        });

    </script>

    @include('flashy::message')

    @livewireScripts

</body>

</html>
