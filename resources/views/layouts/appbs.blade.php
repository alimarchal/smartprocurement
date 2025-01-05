<!doctype html>
<html lang="en">
<head>
    @include('includes.meta')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

    @include('includes.header')

    <div class="app-main">
@include('includes.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title app-page-title-simple">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <div class="page-title-head center-elem">
                                            <span class="d-inline-block pe-2">
                                                <i class="lnr-apartment opacity-6"></i>
                                            </span>
                                   <span class="d-inline-block">@yield('page_title', 'Minimal Dashboard')</span>
                                </div>
                                <div class="page-title-subheading opacity-10">
                                    <nav class="" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a>
                                                    <i aria-hidden="true" class="fa fa-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                               <a>@yield('page_subtitle','Dashboards')</a>
                                            </li>
                                            <li class="active breadcrumb-item" aria-current="page">
                                                 @yield('page_actions','Minimal Dashboard Example')
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
{{--                        <div class="page-title-actions">--}}
{{--                            <div class="d-inline-block pe-3">--}}
{{--                                <select id="custom-inp-top" type="select" class="form-select">--}}
{{--                                    <option>Select period...</option>--}}
{{--                                    <option>Last Week</option>--}}
{{--                                    <option>Last Month</option>--}}
{{--                                    <option>Last Year</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="left"--}}
{{--                                    class="btn btn-dark" title="Show a Toastr Notification!">--}}
{{--                                <i class="fa fa-battery-three-quarters"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
                </div>


                <!-- Flash Messages -->
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

{{--                @include('includes.dashboard-stastics')--}}
            </div>




            @include('includes.footer')
        </div>
    </div>
</div>
{{--@include('includes.right-sidebar')--}}
@include('includes.scripts')
</body>
</html>
