<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <div class="">
                <div class="main-menu-header">
                    @if (Auth::user()->gambar)
                        <img class="img-radius" src="{{ asset('storage/' . Auth::user()->gambar) }}"
                            alt="User-Profile-Image">
                    @else
                        <img class="img-radius" src="{{ asset('assets/images/user/men.jpg') }}" alt="User-Profile-Image">
                    @endif
                    <div class="user-details mt-2">
                        <div id="more-details">{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                {{-- <div class="collapse" id="nav-user-link" style="display: none;">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i
                                    class="feather icon-user m-r-5"></i>Profile</a></li>
                        <li class="list-group-item"><a href="auth-normal-sign-in.html"><i
                                    class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div> --}}
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('users.update', Auth::user()->id) }}" data-toggle="tooltip"
                                title="View Profile">
                                <i class="feather icon-user"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();"
                                    class="dud-logout text-danger" title="Logout" data-toggle="tooltip">
                                    <i class="feather icon-power"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="nav pcoded-inner-navbar mt-2">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pencatatan</label>
                </li>
                <li
                    class="nav-item pcoded-hasmenu {{ request()->routeIs('pencatatan*') | request()->routeIs('servers*') ? 'active' : '' }}">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span class="pcoded-mtext">Pencatatan</span></a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->routeIs('pencatatan*') ? 'active' : '' }}"><a
                                href="{{ route('pencatatan.index') }}">Catatan Kerjaan</a></li>
                        <li class="{{ request()->routeIs('servers*') ? 'active' : '' }}"><a
                                href="{{ route('servers.index') }}">Catatan Server</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Penugasan</label>
                </li>
                <li class="nav-item {{ request()->routeIs('penugasan*') ? 'active' : '' }}">
                    <a href="{{ route('penugasan.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span
                            class="pcoded-mtext">Penugasan</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('harian*') ? 'active' : '' }}">
                    <a href="{{ route('harian.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span class="pcoded-mtext">Tugas
                            Harian</span></a>
                </li>
                @if (Auth::user()->Role->role == 'Super Admin')
                    <li class="nav-item pcoded-menu-caption">
                        <label>Data Master</label>
                    </li>
                    <li
                        class="nav-item pcoded-hasmenu {{ request()->routeIs('level*') | request()->routeIs('status*') | request()->routeIs('job*') | request()->routeIs('role*') ? 'active' : '' }}">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-box"></i></span><span class="pcoded-mtext">Data
                                Master</span></a>
                        <ul class="pcoded-submenu">
                            <li class="{{ request()->routeIs('level*') ? 'active' : '' }}">
                                <a href="{{ route('level.index') }}">Level Urgency</a>
                            </li>
                            <li class="{{ request()->routeIs('lvlSvr*') ? 'active' : '' }}">
                                <a href="{{ route('lvlSvr.index') }}">Level Server</a>
                            </li>
                            <li class="{{ request()->routeIs('status*') ? 'active' : '' }}">
                                <a href="{{ route('status.index') }}">Status Penugasan</a>
                            </li>
                            <li class="{{ request()->routeIs('stsSvr*') ? 'active' : '' }}">
                                <a href="{{ route('stsSvr.index') }}">Status Server</a>
                            </li>
                            <li class="{{ request()->routeIs('job*') ? 'active' : '' }}">
                                <a href="{{ route('job.index') }}">Job Description</a>
                            </li>
                            <li class="{{ request()->routeIs('role*') ? 'active' : '' }}">
                                <a href="{{ route('role.index') }}">Role</a>
                            </li>
                            <li class="{{ request()->routeIs('engine*') ? 'active' : '' }}">
                                <a href="{{ route('engine.index') }}">Engine</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->Role->role == 'Super Admin')
                    <li class="nav-item pcoded-menu-caption">
                        <label>Users</label>
                    </li>
                    <li class="nav-item {{ request()->routeIs('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-users"></i></span><span class="pcoded-mtext">Users</span></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
