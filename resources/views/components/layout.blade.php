@props(['month', 'suppliers'])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    <body class="sb-nav-fixed" style="background-color: rgb(223, 228, 228)">
        <nav class="sb-topnav navbar navbar-expand navbar-light text-light" style="background-color: rgb(62, 128, 227); color: white">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-light" href="index.html">Forecasting Analysis</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 text-light">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile"> Profile Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a href="/logout" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a></li>
                        <form action="/logout" method="post" class="d-none" id="logout">@csrf</form>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light text-dark" id="sidenavAccordion" style="background-color: rgb(255, 255, 255)">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link text-dark" href="/home">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading text-dark">Product and Sales</div>
                            <a class="nav-link text-dark" href="/category">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Product Category
                            </a>
                            <a class="nav-link text-dark" href="/manage-supplier">
                                <div class="sb-nav-link-icon text-dark"><i class="fa-solid fa-truck-field"></i></div>
                                Manage Supplier
                            </a>
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#supplier" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-dark"><i class="fa-solid fa-boxes-packing"></i></div>
                                Suppliers
                                <div class="sb-sidenav-collapse-arrow text-dark"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse text-dark" id="supplier" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                    @foreach ($suppliers as $supplier)
                                        <a class="nav-link" href="/supplier-product?id={{ $supplier->id }}">{{ $supplier->supplier }}</a>
                                    @endforeach

                                </nav>
                            </div>
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow text-dark"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse text-dark" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/add-product">Manage Product</a>
                                    <a class="nav-link" href="/receive">Recieve</a>
                                </nav>
                            </div>
                            <a class="nav-link text-dark" href="/view-inventory">
                                    <div class="sb-nav-link-icon text-dark"><i class="fa-solid fa-coins"></i></div>
                                    Sales Management
                            </a>
                            <div class="sb-sidenav-menu-heading text-dark">Reports</div>

                                <a class="nav-link text-dark" href="/reports">
                                    <div class="sb-nav-link-icon text-dark"><i class="fas fa-chart-area"></i></div>
                                    Reports
                                </a>
                                
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#forecast" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                                Forecast
                                <div class="sb-sidenav-collapse-arrow text-dark"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse text-dark" id="forecast" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/sales-forecast">Sales Forecast</a>
                                </nav>
                            </div>
                             
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        {{$slot}}
                    </div>
                </main>
               
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="/js/inventory.js"></script>
    </body>
</html>
