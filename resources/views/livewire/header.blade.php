<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">

        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('img/New-Sibisma-White.png') }}" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <div class="collapse" id="search-nav">
                <form class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Cari unit..." class="form-control">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <!-- Search Icon Mobile-->
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                        aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <!-- END Search Icon Mobile-->

                <!-- Go to website -->
                <li class="nav-item dropdown hidden-caret">
                    <a href="https://yamahabismagroup.com" class="nav-link" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Go to website">
                        <i class="fas fa-globe"></i>
                    </a>
                </li>
                <!-- END Go to website -->

                <!-- Notification -->
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">User(s) Login</div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-img">
                                            <img src="{{ asset('assets/img/profile2.jpg') }}" alt="Img Profile">
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Reza send messages to you
                                            </span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);">Lihat detail user<i
                                    class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
                <!-- END Notification -->

                <!-- Shortcut -->
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Quick Actions</span>
                            <span class="subtitle op-8">Shortcuts</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-down-arrow-3"></i>
                                            <span class="text">Catat Unit Masuk</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-up-arrow-2"></i>
                                            <span class="text">Catat Unit Keluar</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-interface-1"></i>
                                            <span class="text">Catat Unit Terjual</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-delivery-truck"></i>
                                            <span class="text">Catat Pengiriman</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-file"></i>
                                            <span class="text">Catat Dokumen Kendaraan</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-file-1"></i>
                                            <span class="text">Lihat Laporan</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="
                                avatar-img rounded-circle">
                        </div>
                    </a>
                    @else
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <div class="avatar-img rounded-circle">
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    @endif

                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="avatar-img rounded">
                                        @else
                                            <div class="avatar-img rounded">
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name  }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p><a
                                            href="{{ route('profile.show') }}"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a class="dropdown-item" href="{{ route('api-tokens.index') }}">API Tokens</a>
                                @endif
                                <form action="{{ route('logout') }}" method="post" style="cursor: pointer;">
                                    <a class="dropdown-item" style="color: red;" onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a>
                                </form>
                                <div class="dropdown-divider"></div>
                                <center>
                                    <p style="font-size: 11px; margin-bottom: 0px; color: grey;">
                                        &copy; CRM Bisma <br>
                                        Est. 2019 | SiBisma v.3.0
                                    </p>
                                </center>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
