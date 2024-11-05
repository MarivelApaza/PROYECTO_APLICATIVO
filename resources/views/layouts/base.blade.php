<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            @yield('titulo')
        </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset( 'css/styles.css') }} " rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    @include('layouts._partials.header')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            @include('layouts._partials.menu')
            </div>
            <div id="layoutSidenav_content" style="background-color: #e8e4eb;">
                <main>
                @if (isset($mostrarResumen) && $mostrarResumen)
                    @include('layouts._partials.resumen')
                @endif
                    @yield('contenido')
                </main>
                @include('layouts._partials.footer')
            </div>
        </div>    