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

                    @if(auth()->check())
                    <img src="{{ asset('/avatar/'.auth()->user()->avatar) }}" class="user-img" alt="user avatar">
                    @endif
                    <div class="user-info ps-3">
                        @if(auth()->check())
                            <p class="user-name mb-0 text-white">{{ auth()->user()->full_name}}</p>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/profile/setting') }}"><i class="bx bx-cog"></i><span>Settings</span></a>
                    </li>
                    <li><div class="dropdown-divider mb-0"></div></li>
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle'></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
