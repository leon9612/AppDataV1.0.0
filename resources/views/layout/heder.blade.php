<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>AppData</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{asset('assets/img/AppData.png')}} " rel="icon">
        <link href="{{asset('assets/img/AppData.png')}}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

        <!-- =======================================================
        * Template Name: iPortfolio
        * Updated: Mar 10 2023 with Bootstrap v5.2.3
        * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>
    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile">
              <!--<img src="assets/img/profile-img.jpg" alt="" class="img-fluid rounded-circle">-->
                <br>
                <br>
                <br>
                <h1 class="text-light"><a href="index.html">Usuario</a></h1>
<!--                <div class="social-links mt-3 text-center">
                  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="https://www.facebook.com/tecmmas" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>-->
            </div>

            <nav id="navbar" class="nav-menu navbar " style="height: 260px">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                            <i class="bi bi-car-front-fill"></i><span>Frenos</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                            <li>                                
                                <a href="{{url('/al') }}" id="ali">
                                    <i class="bi bi-gear-fill"></i><span>Alineacion</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/fr') }}" id="fre">
                                    <i class="bi bi-gear-fill"></i><span>Freno mixto</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/frm') }}" id="frem">
                                    <i class="bi bi-gear-fill"></i><span>Freno motos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/su') }}" id="sus">
                                    <i class="bi bi-gear-fill"></i><span>Suspension</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/frmotocarro') }}" id="frem">
                                    <i class="bi bi-gear-fill"></i><span>Freno motocarro</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#" aria-expanded="false">
                            <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                            <li>                                
                                <a href="{{url('/ga') }}" id="gase">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases Mixta</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/gam') }}" id="gasem">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Gases Motos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/op') }}" id="opac">
                                    <i class="bi bi-fuel-pump-diesel-fill"></i><span>Opacidad</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#" aria-expanded="false">
                            <i class="bi bi-lightbulb-fill"></i><span>Luces</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                            <li>                                
                                <a href="{{url('/lu') }}" id="lux">
                                    <i class="bi bi-lightbulb-fill"></i><span>Luces Mixta</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/lum') }}" id="luxm">
                                    <i class="bi bi-lightbulb-fill"></i><span>Luces Motos</span>
                                </a>
                            </li>
                           
                            
                        </ul>
                    </li>

                    <li><a href="{{url('/visual') }}" class="nav-link scrollto" id="visual"><i class="bi bi-eye"></i> <span>Visual</span></a></li>
                    {{-- <li><a href="{{url('/op') }}" class="nav-link scrollto" id="opac"><i class="bi bi-fuel-pump-diesel-fill"></i> <span>Opacidad</span></a></li> --}}
                    {{-- <li><a href="{{url('/lu') }}" class="nav-link scrollto" id="lux"><i class="bi bi-lightbulb-fill"></i> <span>Luces Mixta</span></a></li> --}}
                    {{-- <li><a href="{{url('/lum') }}" class="nav-link scrollto" id="luxm"><i class="bi bi-lightbulb-fill"></i> <span>Luces Motos</span></a></li> --}}
                    <li><a href="{{url('/so') }}" class="nav-link scrollto" id="son"><i class="bi bi-mic-fill"></i> <span>Sonometro</span></a></li>
                    <li><a href="{{url('/tax') }}" class="nav-link scrollto" id="tax"><i class="bi bi-gear-fill"></i> <span>Taximetro</span></a></li>
                    <li><a href="{{url('/update') }}" class="nav-link scrollto" id="actu"><i class="bi bi-arrow-clockwise"></i> <span>Actualizar aplicación</span></a></li>
                    <li>
                        <a href="{{url('/cal') }}" class="nav-link scrollto" id="cal">
                            <i class="bi bi-sliders"></i> <span>Calibracion</span>
                        </a>
                    </li></li>
                    <li><a href="{{url('/close') }}" class="nav-link scrollto" id="close"><i class="bi bi-box-arrow-left"></i> <span>Cerrar sesion</span></a></li>
                    <br><br>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->
   
