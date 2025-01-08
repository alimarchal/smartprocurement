<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title app-page-title-simple">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        @if(request()->routeIs('dashboard'))

                            <div class="page-title-head center-elem">
                                            <span class="d-inline-block pe-2">
                                                <i class="lnr-apartment opacity-6"></i>
                                            </span>
                                <span class="d-inline-block">@yield('page_title', 'Minimal Dashboard')</span>
                            </div>
                        @endif

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

        @yield('content')

    </div>




    @include('includes.footer')
</div>
