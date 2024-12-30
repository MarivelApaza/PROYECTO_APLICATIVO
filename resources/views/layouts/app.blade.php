<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Luminous Kirei') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh; 
    }

    .navbar {
        background-color: #564867;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .navbar-brand img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        color: white;
        font-size: 1rem;
        padding-right: 1rem;
    }

    .navbar-nav .nav-link:hover {
        text-decoration: underline;
    }

    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar input {
        border-radius: 20px 0 0 20px;
    }

    .search-bar button {
        border-radius: 0 20px 20px 0;
    }

    .dropdown-menu {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    main {
        flex-grow: 1;
        margin-top: 0;
        padding: 50px;
    }
    
    /* Estilos de la barra lateral */
    .sidebar {
        background-color: #2C3E50;
        width: 300px;
        height: 100vh;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: relative; /* Cambiado a 'relative' para que se quede dentro del flujo */
    }

    .sidebar .navbar-nav {
        padding-left: 0;
    }

    .sidebar .nav-item {
        margin: 10px 0;
    }

    .sidebar .nav-link {
        color: #ECF0F1;
    }

    .sidebar .nav-link:hover {
        background-color: #34495E;
    }

    /* Ajustes para el contenido principal */
    .content-wrapper {
        margin-left: 250px; /* Esto deja espacio para la barra lateral */
        padding-top: 80px;
        transition: margin-left 0.3s ease;
    }

.container-fluid {
    flex-grow: 1; /* Asegura que el contenido se expanda para ocupar el espacio disponible */
}

    .sidebar-divider {
        border-top: 1px solid #34495E;
    }

</style>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="assets/img/image.png" alt="Logo">
                Luminous Kirei
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="d-flex ms-auto me-3 search-bar">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @auth
    <div class="d-flex">
        <!-- Barra lateral -->
        <div class="sidebar">
            <ul class="navbar-nav">
                <hr class="sidebar-divider my-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('articulos.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Productos</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('articulos.index') }}">Lista Producto</a></li>
                    <li><a class="dropdown-item" href="{{ route('articulos.create') }}">Agregar Producto</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('tipoarticulos.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tipo Artículos</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('tipoarticulos.index') }}">Lista Tipo</a></li>
                    <li><a class="dropdown-item" href="{{ route('tipoarticulos.create') }}">Agregar Tipo</a></li>
                </ul>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('clientes.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('clientes.index') }}">Lista Cliente</a></li>
                    <li><a class="dropdown-item" href="{{ route('clientes.create') }}">Agregar Cliente</a></li>
                </ul>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('proveedores.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-hospital"></i>
                    <span>Proveedores</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('proveedores.index') }}">Lista Proveedor</a></li>
                    <li><a class="dropdown-item" href="{{ route('proveedores.create') }}">Agregar Proveedor</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('ventas.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-hospital"></i>
                    <span>Ventas</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('ventas.index') }}">Lista Venta</a></li>
                    <li><a class="dropdown-item" href="{{ route('ventas.create') }}">Agregar Venta</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="{{ route('usuarios.index') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-hospital"></i>
                <span>Usuarios</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Lista Usuarios</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-hospital"></i>
        <span>Consultas</span>
    </a>
    <!-- Un solo <ul> con ambos elementos -->
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('clientes.consultaCliente') }}">Consultas por Cliente</a></li>
        <li><a class="dropdown-item" href="{{ route('articulos.consultaArticulo') }}">Consultas por Productos</a></li>
    </ul>
</li>



            
            </ul>
        </div>
        @endauth
        <!-- Contenido principal -->
            <div class="container-fluid">
                <!-- Aquí va el contenido principal de la página -->
                @yield('content')
            </div>
    
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
