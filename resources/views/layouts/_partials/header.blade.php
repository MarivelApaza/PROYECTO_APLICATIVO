<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid" style="max-width: auto; margin: 0 auto;">
    <nav class="sb-topnav navbar navbar-expand-lg" style="background-color: #564867; max-width: auto; height: 9%;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-1 d-flex align-items-center" href="index" style="color: white;">
            <img src="assets/img/image.png" alt="Logo" style="width: 40%; height: auto;">
            Luminous Kirei
        </a>
        
        <!-- Botón de hamburguesa -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" data-bs-toggle="collapse" data-bs-target="#accordionSidebar" aria-expanded="false" aria-controls="accordionSidebar">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <!-- Navbar Links -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" v-pre>
                        <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
                    </a>
                    
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('settings') }}">{{ __('Settings') }}</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            @endguest
        </ul>
    </nav>
</div>

</div>
