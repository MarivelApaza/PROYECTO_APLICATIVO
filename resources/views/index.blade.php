<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Mi Empresa</title>
    <!-- Incluir el CSS de Bootstrap desde tu archivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Fuente bonita desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Fuente personalizada */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Fondo de la página */
        body {
            background-image: url('{{ asset('assets/img/FONDO001.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
        }

        /* Contenedor para centrar el contenido */
        .main-container {
            position: absolute;
            color: black;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /* Estilo del logo */
        .logo {
            max-width: 400px;
            margin-bottom: 5px; /* Espacio reducido entre la imagen y el nombre */
        }

        /* Botones personalizados con color turquesa suave */
        .btn-custom {
            background-color: #40E0D0; /* Color turquesa */
            border-color: #40E0D0;
            color: black; /* Texto negro */
            font-size: 18px;
            padding: 15px;
            width: 200px;
            margin-top: 30px;
            border-radius: 50px; /* Bordes redondeados */
            text-decoration: none; /* Eliminar subrayado */
            display: inline-block; /* Asegura que el enlace se comporte como un botón */
            text-align: center; /* Centra el texto dentro del botón */
            transition: background-color 0.3s ease, transform 0.3s ease; /* Efectos de transición */
        }

        .btn-custom:hover {
            background-color: #48C9B0; /* Color más oscuro al pasar el mouse */
            transform: translateY(-5px); /* Efecto de elevación */
        }

        .btn-custom:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(64, 224, 208, 0.6); /* Resplandor al hacer foco */
        }

        /* Espacio entre los botones */
        .d-flex a {
            margin-top: 30px; /* Más espacio entre los botones */
        }

        /* Eliminar subrayado en los enlaces de Bootstrap */
        .text-gray-600, .text-gray-900, .text-gray-400 {
            text-decoration: none !important;
        }

    </style>
</head>
<body>

    <!-- Contenedor principal -->
    <div class="main-container">
        <!-- Logo y nombre de la empresa -->
        <img src="{{ asset('assets/img/image.png') }}" alt="Logo de la Empresa" class="logo">
        <h1>Luminous Kirei</h1>

        <!-- Botones de redirección con Bootstrap -->
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="btn-custom">
                            Home
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-custom">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-custom">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
