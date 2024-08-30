<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyInventory | {{ $tittle }}</title>
    <link rel="icon" href="{{ asset('assets/template/assets_db/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/template/assets_db/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/template/assets_db/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/template/assets_db/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/assets_db/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/assets_db/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/template/assets_db/css/demo.css') }}" />

    <!-- Custom Styles -->
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-body {
            font-size: 1.2rem;
        }

        .dashboard-welcome {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-text {
            font-size: 2rem;
            font-weight: bold;
        }

        .welcome-subtext {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .stats-card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: scale(1.05);
        }

        .recent-activity-img {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('dashboard.layouts.sidebar')


        @include('dashboard.layouts.header')

        @yield('container')

        <!-- JS Files -->
        <script src="{{ asset('assets/template/assets_db/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/template/assets_db/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/template/assets_db/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/template/assets_db/js/kaiadmin.min.js') }}"></script>
        <script src="{{ asset('assets/template/assets_db/js/ready.min.js') }}"></script>


        </script>
        <!--   Core JS Files   -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/core/jquery-3.7.1.min.js"></script>
        <script src="<?= asset('assets/template/assets_db') ?>/js/core/popper.min.js"></script>
        <script src="<?= asset('assets/template/assets_db') ?>/js/core/bootstrap.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

        <!-- Chart JS -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/chart.js/chart.min.js"></script>

        <!-- jQuery Sparkline -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

        <!-- Chart Circle -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/chart-circle/circles.min.js"></script>

        <!-- Datatables -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/datatables/datatables.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

        <!-- jQuery Vector Maps -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/jsvectormap/jsvectormap.min.js"></script>
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/jsvectormap/world.js"></script>

        <!-- Sweet Alert -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/plugin/sweetalert/sweetalert.min.js"></script>

        <!-- Kaiadmin JS -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/kaiadmin.min.js"></script>

        <!-- Kaiadmin DEMO methods, don't include it in your project! -->
        <script src="<?= asset('assets/template/assets_db') ?>/js/setting-demo.js"></script>
        <script src="<?= asset('assets/template/assets_db') ?>/js/demo.js"></script>
        <script>
            $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#177dff",
                fillColor: "rgba(23, 125, 255, 0.14)",
            });

            $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#f3545d",
                fillColor: "rgba(243, 84, 93, .14)",
            });

            $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#ffa534",
                fillColor: "rgba(255, 165, 52, .14)",
            });
        </script>
</body>

</html>
