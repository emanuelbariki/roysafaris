
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ $title }} - RoySafaris Office Managment System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- jvectormap -->
        <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

        @yield('css')

        <style>
            .hide{
                display: none !important;
            }
        </style>

    </head>

    <body class="dark-sidenav">
        <!-- Left Sidenav -->
        @include('layouts.shared.left-sidebar')
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            @include('layouts.shared.topbar')
            <!-- Top Bar End -->
            <!-- Page Content-->
            @yield('content')
            <!-- end page content -->
            @include('layouts.shared.footer')<!--end footer-->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="assets/js/moment.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
        <script>
            function loadcities(selectElement) {
                var countryId = selectElement.value;
                
                if (!countryId) {
                    return;
                }
        
                $.ajax({
                    url: "{{ route('ajax.fetch.cities') }}", // Define the route in Laravel
                    type: "GET",
                    data: { country_id: countryId },
                    success: function(response) {
                        var cityDropdown = $("#city");
                        cityDropdown.empty(); // Clear existing options
                        cityDropdown.append('<option selected disabled>Choose</option>');
        
                        if (response.length > 0) {
                            $.each(response, function(index, city) {
                                cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Error fetching cities:", xhr);
                    }
                });
            }
        </script>

        @yield('scripts')
        
    </body>

</html>