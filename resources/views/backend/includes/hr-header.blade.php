<header>
    <div class="topbar d-flex align-items-center bg-dark shadow-none border-light-2 border-bottom">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu text-white me-3"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu-left d-none d-lg-block">

           </div>
            <div class="top-menu ms-auto"></div>
            <div class="user-box dropdown border-light-2">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        @if(Session::has('name'))
                        <p class="user-name mb-0 text-white">{{ Session::get('name') }}</p>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><div class="dropdown-divider mb-0"></div></li>
                    <li><a class="dropdown-item" href="{{ url('/admin/hr/profile') }}"><i class='bx bx-log-out-circle'></i><span>Profile</span></a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin/user/logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
