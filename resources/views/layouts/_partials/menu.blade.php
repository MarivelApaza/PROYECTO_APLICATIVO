<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #1f1c22; color: white;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ url('/') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Archivos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('producto.index') }}">Productos</a>
                                    <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                                    <a class="nav-link" href="{{ route('proveedor.index') }}">Proveedores</a>
                                    <a class="nav-link" href="#">Tipo Documentos</a>
                                    <a class="nav-link" href="#">Ciudad</a>
                                    <a class="nav-link" href="#">Usuarios</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProcesos" aria-expanded="false" aria-controls="collapseProcesos">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Procesos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProcesos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Registro de Ventas</a>
                                    <a class="nav-link" href="#">Registro de Compras</a>
                                    <a class="nav-link" href="#">Devoluciones</a> 
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConsultas" aria-expanded="false" aria-controls="collapseConsultas">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Consultas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseConsultas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Por Clientes</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Por Artículos</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Stock Productos</a>
                                </nav>
                            </div>

                    </div>
                </nav>