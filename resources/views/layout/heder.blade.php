<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AppData</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/AppData.png') }} " rel="icon">
    <link href="{{ asset('assets/img/AppData.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #149ddd;
            --secondary-color: #173b6c;
            --text-light: #f5f5f5;
            --text-gray: #a8a9b4;
            --bg-dark: #040b14;
            --transition: all 0.3s ease;
        }
        
        /* Estilos mejorados para el menú */
        #header {
            background: var(--bg-dark);
            transition: var(--transition);
        }
        
        .profile {
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }
        
        .profile h1 {
            font-size: 1.5rem;
            margin: 10px 0 5px;
            font-weight: 600;
            color: var(--text-light);
        }
        
        .nav-menu {
            padding: 15px 0;
            overflow-y: auto;
            max-height: calc(100vh - 180px);
        }
        
        .nav-menu::-webkit-scrollbar {
            width: 5px;
        }
        
        .nav-menu::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        .nav-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-menu > ul > li {
            margin-bottom: 5px;
        }
        
        .nav-menu a {
            display: flex;
            align-items: center;
            color: var(--text-gray);
            padding: 12px 15px;
            transition: var(--transition);
            font-size: 15px;
            border-radius: 5px;
            text-decoration: none;
            position: relative;
        }
        
        .nav-menu a i {
            font-size: 18px;
            margin-right: 12px;
            width: 20px;
            text-align: center;
            transition: var(--transition);
        }
        
        .nav-menu a .bi-chevron-down {
            margin-right: 0;
            margin-left: auto;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .nav-menu a:hover, 
        .nav-menu a:focus, 
        .nav-menu a.active {
            text-decoration: none;
            color: var(--text-light);
            background: var(--primary-color);
        }
        
        .nav-menu a:hover i, 
        .nav-menu a:focus i, 
        .nav-menu a.active i {
            color: var(--text-light);
        }
        
        .nav-menu .nav-link.collapsed .bi-chevron-down {
            transform: rotate(-90deg);
        }
        
        .nav-content {
            padding: 5px 0 5px 30px;
            margin: 0;
            list-style: none;
        }
        
        .nav-content li a {
            font-size: 14px;
            padding: 10px 15px;
            border-left: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-content li a:hover {
            border-left-color: var(--primary-color);
        }
        
        .nav-item {
            position: relative;
        }
        
        .menu-badge {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }
        
        .hidden-menu-item {
            display: none !important;
        }
        
        /* Asegurar que los submenús colapsados de Bootstrap funcionen correctamente */
        .nav-content.collapse:not(.show) {
            display: none;
        }
        
        .nav-content.collapse.show {
            display: block;
        }
        
        /* Mejoras responsivas */
        @media (max-width: 1199px) {
            #header {
                left: -300px;
            }
            
            .mobile-nav-active #header {
                left: 0;
            }
            
            .nav-menu {
                padding: 15px 0;
            }
        }
        
        /* Animación suave para los elementos del menú */
        .nav-content li {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        .nav-content li.hidden-menu-item {
            opacity: 0;
            height: 0;
            overflow: hidden;
            margin: 0;
            padding: 0;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">
            <div class="profile">
                <img src="{{ asset('assets/img/AppData.png') }}" alt="Logo AppData" class="rounded-circle" width="80">
                <h1 class="text-light"><a href="index.html">Usuario</a></h1>
                <p class="text-muted small">Bienvenido al sistema</p>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-car-front-fill"></i><span>Frenos</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                            <span class="menu-badge">5</span>
                        </a>
                        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#navbar">
                            <li>                                
                                <a href="{{ url('/al') }}" id="ali">
                                    <i class="bi bi-gear-fill"></i><span>Alineación</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/fr') }}" id="fre">
                                    <i class="bi bi-gear-fill"></i><span>Freno mixto</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/frm') }}" id="frem">
                                    <i class="bi bi-gear-fill"></i><span>Freno motos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/su') }}" id="sus">
                                    <i class="bi bi-gear-fill"></i><span>Suspensión</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/frmotocarro') }}" id="fremc">
                                    <i class="bi bi-gear-fill"></i><span>Freno motocarro</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                            <span class="menu-badge">3</span>
                        </a>
                        <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#navbar">
                            <li>                                
                                <a href="{{ url('/ga') }}" id="gase">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases Mixto</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/gam') }}" id="gasem">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases Motos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/op') }}" id="opac">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Opacidad</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-lightbulb-fill"></i><span>Luces</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                            <span class="menu-badge">2</span>
                        </a>
                        <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#navbar">
                            <li>                                
                                <a href="{{ url('/lu') }}" id="lux">
                                    <i class="bi bi-lightbulb-fill"></i><span>Luces Mixto</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/lum') }}" id="luxm">
                                    <i class="bi bi-lightbulb-fill"></i><span>Luces Motos</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/visual') }}" class="nav-link scrollto" id="visual">
                            <i class="bi bi-eye"></i> <span>Visual</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ url('/so') }}" class="nav-link scrollto" id="son">
                            <i class="bi bi-mic-fill"></i> <span>Sonómetro</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ url('/tax') }}" class="nav-link scrollto" id="tax">
                            <i class="bi bi-speedometer2"></i> <span>Taxímetro</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ url('/update') }}" class="nav-link scrollto" id="actu">
                            <i class="bi bi-arrow-clockwise"></i> <span>Actualizar</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ url('/cal') }}" class="nav-link scrollto" id="cal">
                            <i class="bi bi-sliders"></i> <span>Calibración</span>
                        </a>
                    </li>
                    
                    <li class="nav-item mt-3">
                        <a href="{{ url('/close') }}" class="nav-link scrollto" id="close">
                            <i class="bi bi-box-arrow-left"></i> <span>Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>