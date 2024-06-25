<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield(env('APP_NAME') . 'title', env('APP_NAME'))</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/images/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pickers/flatpickr/flatpickr.min.css') }}">
    {{-- @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/themes/dark-layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/themes/semi-dark-layout.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('asset/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/custom-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/vendors-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('asset/css-rtl/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    {{-- @else
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/bootstrap-extended.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/colors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/components.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/themes/dark-layout.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/themes/semi-dark-layout.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('asset/css-ltr/core/menu/menu-types/vertical-menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/vendors/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('asset/css-ltr/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    @endif --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/cust.css') }}">

    @stack('csslive')
    <style>

        .la-ball-pulse-sync,
        .la-ball-pulse-sync>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-pulse-sync {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-pulse-sync.la-dark {
            color: #333;
        }

        .la-ball-pulse-sync>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-pulse-sync {
            width: 54px;
            height: 18px;
        }

        .la-ball-pulse-sync>div {
            width: 10px;
            height: 10px;
            margin: 4px;
            border-radius: 100%;
            -webkit-animation: ball-pulse-sync .6s infinite ease-in-out;
            -moz-animation: ball-pulse-sync .6s infinite ease-in-out;
            -o-animation: ball-pulse-sync .6s infinite ease-in-out;
            animation: ball-pulse-sync .6s infinite ease-in-out;
        }

        .la-ball-pulse-sync>div:nth-child(1) {
            -webkit-animation-delay: -.14s;
            -moz-animation-delay: -.14s;
            -o-animation-delay: -.14s;
            animation-delay: -.14s;
        }

        .la-ball-pulse-sync>div:nth-child(2) {
            -webkit-animation-delay: -.07s;
            -moz-animation-delay: -.07s;
            -o-animation-delay: -.07s;
            animation-delay: -.07s;
        }

        .la-ball-pulse-sync>div:nth-child(3) {
            -webkit-animation-delay: 0s;
            -moz-animation-delay: 0s;
            -o-animation-delay: 0s;
            animation-delay: 0s;
        }

        .la-ball-pulse-sync.la-sm {
            width: 26px;
            height: 8px;
        }

        .la-ball-pulse-sync.la-sm>div {
            width: 4px;
            height: 4px;
            margin: 2px;
        }

        .la-ball-pulse-sync.la-2x {
            width: 108px;
            height: 36px;
        }

        .la-ball-pulse-sync.la-2x>div {
            width: 20px;
            height: 20px;
            margin: 8px;
        }

        .la-ball-pulse-sync.la-3x {
            width: 162px;
            height: 54px;
        }

        .la-ball-pulse-sync.la-3x>div {
            width: 30px;
            height: 30px;
            margin: 12px;
        }

        /*
 * Animation
 */
        @-webkit-keyframes ball-pulse-sync {
            33% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }

            66% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @-moz-keyframes ball-pulse-sync {
            33% {
                -moz-transform: translateY(100%);
                transform: translateY(100%);
            }

            66% {
                -moz-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                -moz-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @-o-keyframes ball-pulse-sync {
            33% {
                -o-transform: translateY(100%);
                transform: translateY(100%);
            }

            66% {
                -o-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                -o-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes ball-pulse-sync {
            33% {
                -webkit-transform: translateY(100%);
                -moz-transform: translateY(100%);
                -o-transform: translateY(100%);
                transform: translateY(100%);
            }

            66% {
                -webkit-transform: translateY(-100%);
                -moz-transform: translateY(-100%);
                -o-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                -webkit-transform: translateY(0);
                -moz-transform: translateY(0);
                -o-transform: translateY(0);
                transform: translateY(0);
            }
        }
    </style>
    <style>
        .navigation .navigation-header,
        .navigation,
        .header-navbar,
        body {
            font-family: 'Cairo', 'sans-serif' !important;
        }
    </style>
</head>
