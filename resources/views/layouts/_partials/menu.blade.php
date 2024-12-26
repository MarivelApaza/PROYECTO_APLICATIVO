<!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript de Bootstrap (al final del archivo antes de </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar -->
<div class="d-flex" id="wrapper">
    <!-- Sidebar colapsable -->
    <div class="bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="width: 250px; background-color: #2C3E50;">
        <ul class="navbar-nav">
            <!-- Divider -->
            <hr class="sidebar-divider my-0" style="border-top: 1px solid #34495E;">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="true" aria-controls="collapseVentas">
                    <i class="fas fa-fw fa-cog" style="color: #ECF0F1;"></i>
                    <span style="color: #ECF0F1;">Ventas</span>
                </a>
                <div id="collapseVentas" class="collapse" aria-labelledby="headingVentas" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="" style="color: #2C3E50;">Nueva venta</a>
                        <a class="collapse-item" href="" style="color: #2C3E50;">Ventas</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Productos Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductos" aria-expanded="true" aria-controls="collapseProductos">
                    <i class="fas fa-fw fa-box" style="color: #ECF0F1;"></i>
                    <span style="color: #ECF0F1;">Productos</span>
                </a>
                <div id="collapseProductos" class="collapse" aria-labelledby="headingProductos" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="" style="color: #2C3E50;">Nuevo Producto</a>
                        <a class="collapse-item" href="" style="color: #2C3E50;">Productos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Clientes Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClientes" aria-expanded="true" aria-controls="collapseClientes">
                    <i class="fas fa-users" style="color: #ECF0F1;"></i>
                    <span style="color: #ECF0F1;">Clientes</span>
                </a>
                <div id="collapseClientes" class="collapse" aria-labelledby="headingClientes" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="" style="color: #2C3E50;">Nuevo Cliente</a>
                        <a class="collapse-item" href="" style="color: #2C3E50;">Clientes</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Proveedores Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseProveedor">
                    <i class="fas fa-truck" style="color: #ECF0F1;"></i>
                    <span style="color: #ECF0F1;">Proveedor</span>
                </a>
                <div id="collapseProveedor" class="collapse" aria-labelledby="headingProveedor" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="" style="color: #2C3E50;">Nuevo Proveedor</a>
                        <a class="collapse-item" href="" style="color: #2C3E50;">Proveedores</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main content area -->
    <div id="page-content-wrapper" style="flex-grow: 1; background-color: #ECF0F1;">
        <!-- Aquí va el contenido principal de la página -->
    </div>
</div>

<!-- Incluir los iconos de FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<!-- Incluir los archivos de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
