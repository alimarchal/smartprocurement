<!doctype html>
<html lang="en">
<head>
    @include('includes.meta')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar ">

    @include('includes.header')

    <div class="app-main">
        @include('includes.sidebar')
        @include('includes.app-main-outer')
    </div>
    @yield('app-outer')


</div>
    @include('includes.scripts')
</body>
</html>
