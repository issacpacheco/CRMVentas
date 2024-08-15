<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Joyeria</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Menú</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Panel administrativo
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Administración</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                <a class="collapse-item" href="javascript:void(0);" onclick="Vista('administracion','usuarios','catalogo')">Usuarios</a>
                <a class="collapse-item" href="javascript:void(0);" onclick="Vista('administracion','almacen','catalogo')">Almacenes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Ventas</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                <a class="collapse-item" href="javascript:void(0);">Punto de venta</a>
                <a class="collapse-item" href="javascript:void(0);">Caja</a>
                <a class="collapse-item" href="javascript:void(0);">Gastos</a>
                <a class="collapse-item" href="javascript:void(0);">Cotizaciones</a>
                <a class="collapse-item" href="javascript:void(0);">Prospectos</a>
                <a class="collapse-item" href="javascript:void(0);">Clientes</a>
            </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="true" aria-controls="collapseReportes">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Reportes</span>
        </a>
        <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                <a class="collapse-item" href="javascript:void(0);">Rep. Caja</a>
                <a class="collapse-item" href="javascript:void(0);">Rep. Ventas</a>
                <a class="collapse-item" href="javascript:void(0);">Rep. Gastos</a>
            </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlmacen" aria-expanded="true" aria-controls="collapseAlmacen">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Almacen</span>
        </a>
        <div id="collapseAlmacen" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                <a class="collapse-item" href="javascript:void(0);" onclick="Vista('almacen','categorias','catalogo')">Categorias</a>
                <a class="collapse-item" href="javascript:void(0);" onclick="Vista('almacen','productos','catalogo')">Lista de productos</a>
                <a class="collapse-item" href="javascript:void(0);" onclick="Vista('almacen','entradas','catalogo')">Entradas</a>
                <a class="collapse-item" href="javascript:void(0);">Salidas</a>
                <a class="collapse-item" href="javascript:void(0);">Transferencias</a>
            </div>
        </div>
    </li>
</ul>