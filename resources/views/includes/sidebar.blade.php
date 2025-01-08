<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ms-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li class="mm-active mm-show">
                    <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) mm-active @endif">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboards
{{--                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>--}}
                    </a>
                </li>


                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-config"></i>
                        Administration
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li @if(request()->routeIs('categories.*')) class="mm-active" @endif>
                            <a href="{{ route('categories.index') }}">
                                <i class="metismenu-icon"></i>
                                Categories
                            </a>
                        </li>
                        <li @if(request()->routeIs('items.*')) class="mm-active" @endif>
                            <a href="{{ route('items.index') }}">
                                <i class="metismenu-icon"></i>
                                Items
                            </a>
                        </li>
                        <li @if(request()->routeIs('customers.*')) class="mm-active" @endif>
                            <a href="{{ route('customers.index') }}">
                                <i class="metismenu-icon"></i>
                                Customers
                            </a>
                        </li>
                    </ul>
                </li>

{{--                <li>--}}
{{--                    <a href="{{ route('customers.index') }}" class="@if(request()->routeIs('customers.*')) mm-active @endif">--}}
{{--                        <i class="metismenu-icon pe-7s-users"></i>--}}
{{--                        Customers (Buyers)--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{ route('items.index') }}" class="@if(request()->routeIs('items.*')) mm-active @endif">--}}
{{--                        <i class="metismenu-icon pe-7s-users"></i>--}}
{{--                        Items--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{ route('items.store') }}" class="@if(request()->routeIs('items.*')) mm-active @endif">--}}
{{--                        <i class="metismenu-icon pe-7s-users"></i>--}}
{{--                        Items--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-browser"></i>
                        Pages
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="pages-login.html">
                                <i class="metismenu-icon"></i>
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="pages-login-boxed.html">
                                <i class="metismenu-icon"></i>
                                Login Boxed
                            </a>
                        </li>
                        <li>
                            <a href="pages-register.html">
                                <i class="metismenu-icon"></i>
                                Register
                            </a>
                        </li>
                        <li>
                            <a href="pages-register-boxed.html">
                                <i class="metismenu-icon"></i>
                                Register Boxed
                            </a>
                        </li>
                        <li>
                            <a href="pages-forgot-password.html">
                                <i class="metismenu-icon"></i>
                                Forgot Password
                            </a>
                        </li>
                        <li>
                            <a href="pages-forgot-password-boxed.html">
                                <i class="metismenu-icon"></i>
                                Forgot Password Boxed
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-plugin"></i>
                        Applications
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="apps-mailbox.html">
                                <i class="metismenu-icon"></i>
                                Mailbox
                            </a>
                        </li>
                        <li>
                            <a href="apps-chat.html">
                                <i class="metismenu-icon"></i>
                                Chat
                            </a>
                        </li>
                        <li>
                            <a href="apps-faq-section.html">
                                <i class="metismenu-icon"></i>
                                FAQ Section
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon"></i>
                                Forums
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="apps-forum-list.html">
                                        <i class="metismenu-icon"></i>
                                        Forum Listing
                                    </a>
                                </li>
                                <li>
                                    <a href="apps-forum-threads.html">
                                        <i class="metismenu-icon"></i>
                                        Forum Threads
                                    </a>
                                </li>
                                <li>
                                    <a href="apps-forum-discussion.html">
                                        <i class="metismenu-icon"></i>
                                        Forum Discussion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="app-sidebar__heading">My Account</li>
                <li>
                    <a href="{{ route('profile.show') }}" class="@if(request()->routeIs('profile.show')) mm-active @endif">
                        <i class="metismenu-icon lnr-user"></i>
                        My Profile
                    </a>
                </li>

                @if(!empty(Auth::user()->company))
                    <li>
                        <a href="{{ route('companies.edit', Auth::user()->company->id) }}" class="@if(request()->routeIs('companies.edit')) mm-active @endif">
                            <i class="metismenu-icon pe-7s-id"></i>
                            Company Profile
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('profile.show',['#password']) }}" class="@if(request()->routeIs('profile.show')) mm-active @endif">
                        <i class="metismenu-icon lnr-sync"></i>
                        Change Password
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
