<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{asset('fonts/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="{{asset('fonts/material-design-icons/material-icon.css')}}" rel="stylesheet" type="text/css" />
    <!--bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" integrity="sha512-thoh2veB35ojlAhyYZC0eaztTAUhxLvSZlWrNtlV01njqs/UdY3421Jg7lX0Gq9SRdGVQeL8xeBp9x1IPyL1wQ==" crossorigin="anonymous" />    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/google/material-design-lite@1.3.0/material.min.css">
    <!-- Theme Styles -->
    <link href="{{asset('css/theme_style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/light/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/light/theme-color.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        @include('partials.header')
        <!-- start page container -->
        <div class="page-container">
            @include('partials.sidebar')
            <div class="page-content-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- end page container -->
        @include('partials.footer')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" integrity="sha512-cJMgI2OtiquRH4L9u+WQW+mz828vmdp9ljOcm/vKTQ7+ydQUktrPVewlykMgozPP+NUBbHdeifE6iJ6UVjNw5Q==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js" integrity="sha512-ZvbjbJnytX9Sa03/AcbP/nh9K95tar4R0IAxTS2gh2ChiInefr1r7EpnVClpTWUEN7VarvEsH3quvkY1h0dAFg==" crossorigin="anonymous"></script>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/layout.js')}}"></script>
    <script src="{{asset('js/theme-color.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js" integrity="sha512-mPYFRGkgrXvIQo9eMKjv5vuy73j7kXXelllj3W49nVCKarBVOUxNai2dnqVIp8QnnVS7AKHwdFyZSVibSqWtkw==" crossorigin="anonymous"></script>

    @yield('scripts')
</body>
</html>
