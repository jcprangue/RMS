<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RMS') }}</title>
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/DataTables/Bootstrap-4-4.1.1/js/bootstrap.min.js') }}" defer></script>
    <!-- table -->
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.js') }}" defer></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}" defer></script>
    
    <!-- <link rel="stylesheet" href="{{ asset('css/selectize.min.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/selectize.min.css') }}" />
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/selectize.min.js') }} "></script>

    <!-- chart -->
    <script src="{{ asset('js/Chart.js') }}" defer></script>
    <script src="{{ asset('js/Chart.min.js') }}" defer></script>
    
    <!-- pnotify -->
    <script src="{{ asset('js/pnotify.custom.min.js') }}" defer></script>
    
    <!-- buttons -->
    <script src="{{ asset('plugins/DataTables/Buttons-1.5.2/js/dataTables.buttons.js') }}" defer></script>
    <script src="{{ asset('plugins/DataTables/Buttons-1.5.2/js/buttons.bootstrap4.js') }}" defer></script>

    <!-- select -->
    <script src="{{ asset('plugins/DataTables/Select-1.2.6/js/select.bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- responsive -->
    <script src="{{ asset('plugins/DataTables/Responsive-2.2.2/js/dataTables.responsive.js') }}" defer></script>
    <script src="{{ asset('plugins/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js') }}" defer></script>


    <link href="{{ asset('font/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Buttons-1.5.2/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Select-1.2.6/css/select.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Responsive-2.2.2/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.custom.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet"/>

    <style type="text/css">
      
        .bg-radius-color{
           border: 1px solid #0D47A1 !important;
        }

        .bg-card-header{
            background-color: #0D47A1 !important;
            color:#FFF;
        }

        .bg-lightnav{
            background-color: #0d52bc !important;
        }

        table.dataTable tbody tr.selected {
            color: white;
            background-color: #E0E0E0;  /* Not working */
        }

       
    </style>

   
</head>
<body>
    @include('Components.navbar')
    @include('Components.sidebar')
    <div class="container-fluid">
        @yield('content')

    </div>
    

      
</div>       





   
</body>

 <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

             $('#txtdateleave').datepicker({
                uiLibrary: 'bootstrap4',
                 multidate: true
            });

            setNavigation();
        });


        function setNavigation() {
            var path = window.location.pathname;
            path = path.replace(/\/$/, "");
            path = decodeURIComponent(path);
            $("#sidebar ul li a").each(function () {
                var href = $(this).attr('href');
                
                if (href.includes(path)) {
                    $(this).closest('li').addClass('active');
                }

            });
        }
    </script>

</html>
