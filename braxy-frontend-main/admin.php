<?php
    session_start();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://cevicherias.informaticapp.com/sucursal/'.$_GET['sucu_id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VWYVRVZXpBOFQuSEYza25WTjZLUTVMSzBSc1Nwc0tPOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlSGdrN1Q1dWswNGhrWFN1MG9GYmdBZFZ3dkxSbWt2dQ=='
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);

    $valorGlobal = $_SESSION['mi_variable_global'];
//    var_dump($data["Detalle"]["0"]["sucu_id"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="logo.ico">
        <title><?= $valorGlobal[0]['sucu_nombre'] ?> - Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <!-- MAIN -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">BRAXLY</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-7 me-2 me-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Editar perfil</a></li>
                        <li><a class="dropdown-item" href="cerrar_login.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Principal
                            </a>
                            <div class="sb-sidenav-menu-heading">Modulos</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="bi bi-receipt-cutoff"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="module_venta/pedidos_template/pedidos_html.php">Registrar Pedidos</a>
                                    <a class="nav-link" href="module_venta/module_cliente/cliente_html.php">Registrar Clientes</a>
                                    <a class="nav-link" href="module_venta/detalle_pedido_template/detalle_pedido_html.php">Detalles del Pedido</a>
                                    <a class="nav-link" href="module_venta/reservas_template/reservas_html.php">Detalles de Reserva</a>
                                </nav>
                            </div>  
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSeguridad" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="bi bi-shield-check"></i></div>
                                Seguridad
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSeguridad" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="module_seguridad/trabajador_template/trabajador_html.php">Registrar Trabajadores</a>
                                    <a class="nav-link" href="module_seguridad/usuario_template/usuario_html.php">Registrar Perfiles</a>
                                    <a class="nav-link" href="module_seguridad/permisos_template/permiso_html.php">Registrar Permisos</a>
                                    <a class="nav-link" href="module_seguridad/empresa_template/empresa_html.php">Registrar Empresa</a>
                                    
                                </nav>
                            </div>  
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="bi bi-bag-fill"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="module_compras/platos_template/platos_html.php">Registrar Platos</a>
                                    <a class="nav-link" href="module_compras/tipo_producto_template/tipo_producto_html.php">Registrar tipo de producto</a>
                                    <a class="nav-link" href="module_compras/productos_template/productos_html.php">Registrar Productos</a>
                                    <a class="nav-link" href="module_compras/proveedores_template/proveedores_html.php">Registrar Proveedores</a>
                                    <a class="nav-link" href="module_compras/inventario_template/inventario_html.php">Inventario</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReportes" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="bi bi-clipboard-data-fill"></i></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="module_reportes/reportes_clientes_template/reportes_clientes_html.php">Reporte de Clientes</a>
                                    <a class="nav-link" href="module_reportes/reportes_pedidos_template/reportes_pedidos_html.php">Reporte de Pedidos</a>
                                <a class="nav-link" href="module_reportes/reportes_productos_template/reportes_productos_html.php">Reporte de Inventario</a>
                                    <a class="nav-link" href="module_reportes/reportes_reclamos_template/reportes_reclamos_html.php">Reporte de Reclamos</a>
                                    <a class="nav-link" href="module_reportes/reportes_reservas_template/reportes_reservas_html.php">Reporte de Reservas</a>
                                    <a class="nav-link" href="module_reportes/reportes_ventas_template/reportes_ventas_html.php">Reporte de Ventas</a>
                                </nav>
                            </div> 
                        </div>
                        
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Iniciado sesión como:</div>
                        Trabajador
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenido al <?= $valorGlobal[0]['sucu_nombre'] ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Eres <?= $valorGlobal[0]['tiad_nombre'] ?></li>
                        </ol>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-2">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Braxly UPeU - 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="assets/demo/chart-area-demo.js"></script>-->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
