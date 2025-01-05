<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@yield('title', config('app.name', 'Laravel')) - @yield('subtitle', 'Dashboard')</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name="description" content="Examples of just how powerful ArchitectUI really is!">
<!-- Disable tap highlight on IE -->
<meta name="msapplication-tap-highlight" content="no">


<link rel="stylesheet" href="{{ asset('architectui/vendors/@fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('architectui/vendors/ionicons-npm/css/ionicons.css') }}">
<link rel="stylesheet" href="{{ asset('architectui/vendors/linearicons-master/dist/web-font/style.css') }}">
<link rel="stylesheet" href="{{ asset('architectui/vendors/pixeden-stroke-7-icon-master/pe-icon-7-stroke/dist/pe-icon-7-stroke.css') }}">
<link href="{{ asset('architectui/styles/css/base.css') }}" rel="stylesheet">
<!-- Additional Styles -->
@stack('styles')
