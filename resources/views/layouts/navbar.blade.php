<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="{{ asset('assets/images/Logo1.png') }}" alt="" width="185px">
                <span class="badge bg-light-success rounded-pill theme-version">v2.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            @if (Auth::user()->gambar)
                                <img class="user-avtar wid-45 rounded-circle"
                                    src="{{ asset('storage/' . Auth::user()->gambar) }}" alt="User-Profile-Image">
                            @else
                                <img class="user-avtar wid-45 rounded-circle"
                                    src="{{ asset('assets/images/user/men.jpg') }}" alt="User-Profile-Image">
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0 ml-2"> {{ Auth::user()->name }}</h6>
                            <small class="ml-2"> {{ Auth::user()->Role->role }}</small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('users.update', Auth::user()->id) }}" data-toggle="tooltip"
                                title="View Profile">
                                <i class="ti ti-user"></i>
                                <span>My Account</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                            this.closest('form').submit();"
                                    class="dud-logout text-danger" title="Logout" data-toggle="tooltip">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item pc-hasmenu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up">
                                </use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li
                    class="pc-item pc-hasmenu {{ request()->routeIs('pencatatan*') | request()->routeIs('servers*') ? 'active pc-trigger' : '' }}">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-document">
                                </use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Pencatatan</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item {{ request()->routeIs('pencatatan*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('pencatatan.index') }}">Catatan Pekerjaan</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('servers*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('servers.index') }}">Catatan Server</a>
                        </li>
                </li>
            </ul>
            </li>
            <li class="pc-item pc-caption">
                <label>Penugasan</label>
                <svg class="pc-icon">
                    <use xlink:href="#custom-presentation-chart">
                    </use>
                </svg>
            </li>

            <li class="pc-item {{ request()->routeIs('penugasan*') ? 'active' : '' }}">
                <a href="{{ route('penugasan.index') }}" class="pc-link">
                    <span class="pc-micon">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-story">
                            </use>
                        </svg>
                    </span>
                    <span class="pc-mtext">Penugasan</span>
                </a>
            </li>
            <li class="pc-item {{ request()->routeIs('harian*') ? 'active' : '' }}">
                <a href="{{ route('harian.index') }}" class="pc-link">
                    <span class="pc-micon">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-fatrows">
                            </use>
                        </svg>
                    </span>
                    <span class="pc-mtext">Tugas Harian</span>
                </a>
            </li>
            @if (Auth::user()->Role->role == 'Super Admin')
                <li class="pc-item pc-caption">
                    <label>Data Master</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-box-1">
                        </use>
                    </svg>
                </li>

                <li
                    class="pc-item pc-hasmenu {{ request()->routeIs('level*') | request()->routeIs('status*') | request()->routeIs('job*') | request()->routeIs('role*') ? 'active pc-trigger' : '' }}">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-mouse-circle">
                                </use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Data Master</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item {{ request()->routeIs('level*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('level.index') }}">Level Urgency</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('lvlSvr*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('lvlSvr.index') }}">Level Server</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('status*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('status.index') }}">Status Penugasan</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('stsSvr*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('stsSvr.index') }}">Status Server</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('job*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('job.index') }}">Job Description</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('role*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('role.index') }}">Role</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('engine*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('engine.index') }}">Engine</a>
                        </li>
                        <li class="pc-item {{ request()->routeIs('backup*') ? 'active' : '' }}">
                            <a class="pc-link" href="{{ route('backup.index') }}">Kondisi Backup Server</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->Role->role == 'Super Admin')
                <li class="pc-item pc-caption">
                    <label>Users</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-element-plus">
                        </use>
                    </svg>
                </li>
                <li class="pc-item {{ request()->routeIs('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-fatrows">
                                </use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Users</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</nav>
