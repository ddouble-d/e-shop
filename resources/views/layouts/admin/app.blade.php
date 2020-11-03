<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />


    <!-- Styles -->
    <link id="sleek-css" rel="stylesheet" href="{{ asset('admin/assets/css/sleek.min.css') }}">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>


</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <div class="wrapper">

        <!--LEFT SIDEBAR WITH FOOTER -->
        @include('layouts.admin.left-sidebar')

        <div class="page-wrapper">
            <!-- Header -->
            @include('layouts.admin.header')

            <!-- Page Content -->
            @yield('content')

            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard
                        Bootstrap Template by
                        <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sleek.bundle.js') }}"></script>
    <script>
        $(".delete").on("submit", function() {
            return confirm("Do you want to remove this?");
        });

        function showHideConfigurableAttributes() {
			var productType = $(".product-type").val();

			if (productType == 'configurable') {
				$(".configurable-attributes").show();
			} else {
				$(".configurable-attributes").hide();
			}
		}

		$(function(){
			showHideConfigurableAttributes();
			$(".product-type").change(function() {
				showHideConfigurableAttributes();
			});
		});
    </script>

</body>

</html>
