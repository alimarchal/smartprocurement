<div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
    <div class="dropdown-menu-header">
        <div class="dropdown-menu-header-inner bg-info">
            <div class="menu-header-image opacity-2" style="background-image: url('{{ asset('architectui/images/dropdown-header/city3.jpg') }}');"></div>
            <div class="menu-header-content text-start">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left me-3">
                            <img width="42" class="rounded-circle" src="{{ asset('architectui/images/avatars/1.jpg') }}" alt="">
                        </div>
                        <div class="widget-content-left">
                            <div class="widget-heading">{{ Auth::user()->name ?? 'User Name' }}</div>
                            <div class="widget-subheading opacity-8">A short profile description</div>
                        </div>
                        <div class="widget-content-right me-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-area-xs" style="height: 150px;">
        <div class="scrollbar-container ps">
            <ul class="nav flex-column">
                <li class="nav-item-header nav-item">Activity</li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        Chat
                        <div class="ms-auto badge rounded-pill bg-info">8</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">Recover Password</a>
                </li>
                <li class="nav-item-header nav-item">
                    My Account
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        Settings
                        <div class="ms-auto badge bg-success">New</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        Messages
                        <div class="ms-auto badge bg-warning">512</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">Logs</a>
                </li>
            </ul>
        </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item-divider mb-0 nav-item"></li>
    </ul>
    <div class="grid-menu grid-menu-2col">
        <div class="g-0 row">
            <div class="col-sm-6">
                <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                    <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                    Message Inbox
                </button>
            </div>
            <div class="col-sm-6">
                <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                    <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                    <b>Support Tickets</b>
                </button>
            </div>
        </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item-divider nav-item"></li>
        <li class="nav-item-btn text-center nav-item">
            <button class="btn-wide btn btn-primary btn-sm">Open Messages</button>
        </li>
    </ul>
</div>
