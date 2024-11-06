<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MY CINEMA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap"
        rel="stylesheet">

    <!-- Icon Fontawesome Stylesheet -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }} " rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }} " rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/bootstrap.min.css') }} " rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user/css/style.css') }} " rel="stylesheet">

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        <a href="#" class="navbar-brand ms-4 ms-lg-0 box" style="--color: #da044f;">
            <h3>
                <i class="fa-brands fa-monero M"></i><i class="fa-brands fa-yoast Y"></i><i
                    class="fa-regular fa-copyright C"></i>INEMA
            </h3>
        </a>

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ms-auto p-4 p-lg-0">

                <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>

                <a href="#" class="nav-item nav-link" onclick="alertMes()">Movies</a>

                <a href="#" class="nav-item nav-link" onclick="alertMes()">Comments</a>

                <a href="#" class="nav-item nav-link" onclick="alertMes()">Contact</a>

                <a href="#" class="nav-item nav-link" onclick="alertMes()">
                    <button type="button" class="btn btn-sm bg-danger text-dark position-relative me-3" style="border-radius: 10px;">
                        <i class="fa-regular fa-calendar-check"></i>
                        <span
                            class=" text-danger position-absolute start-100 translate-middle badge rounded-pill bg-white">
                            0
                        </span>
                    </button>
                </a>

                <a href="#" class="nav-item nav-link" onclick="alertMes()">
                    <button type="button" class="btn btn-sm bg-danger text-dark me-2 position-relative historyBtn" style="border-radius: 10px;">
                        <i class="fa-solid fa-clock-rotate-left"></i>History
                        <span
                            class="text-danger position-absolute start-100 translate-middle badge rounded-pill bg-white">
                            0
                        </span>
                    </button>
                </a>
            </div>
            <a href="{{route('auth#loginPage')}}">
                <button class="btn bg-danger text-white py-2 px-3" style="border-radius: 20px">Login here</button>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Home Start -->
    <div id="header-carousel" class="container-fluid p-0 carousel slide wow fadeIn" data-bs-ride="carousel"
        data-wow-delay="0.6s">

        <div class="carousel-inner">

            <div class="carousel-item row">

                <img src="{{ asset('user/img/bg3.jpg') }}" class="">

                <div class="home-text pb-5">

                    <h2>
                        <i class="fa-brands fa-monero M"></i><i class="fa-brands fa-yoast Y"></i><i
                            class="fa-regular fa-copyright C"></i>INEMA
                    </h2>

                    <h3 class="py-3">ShowTime :</h3>

                    <div class="dateBtn">
                        <div>
                            <button><span>| Sun |</span></button>
                            <button><span>| Mon |</span></button>
                            <button><span>| Tues |</span></button>
                            <button><span>| Wed |</span></button>
                        </div>
                        <div>
                            <button><span>| Thu |</span></button>
                            <button><span>| Fri |</span></button>
                            <button><span>| Sat |</span></button>
                        </div>
                    </div>

                    <div class="time mt-3">9:30 | 12:30 | 3:00 | 5:30 </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Home End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-light footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Get In Touch</h4>
                    <div class="d-flex align-items-center mb-2">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-map-marker-alt text-primary"></span>
                        </div>
                        <span>123 Street, Pyay, MYANMAR</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-phone-alt text-primary"></span>
                        </div>
                        <span>+959966776997</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="btn-square bg-dark flex-shrink-0 me-3">
                            <span class="fa fa-envelope-open text-primary"></span>
                        </div>
                        <span>mycinema@example.com</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">Home</a>

                    <a class="btn btn-link" href="">Moviess</a>
                    <a class="btn btn-link" href="">Comments</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    {{-- <a class="btn btn-link" href="">Support</a> --}}
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-uppercase mb-4">Newsletter</h4>
                    <div class="position-relative mb-4">
                        <form action="#" >
                            @csrf

                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="sending with mail" name="message">
                            <button type="submit" onclick="alertMes()"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Send</button>
                        </form>
                    </div>
                    <div class="d-flex pt-1 m-n1">
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-lg-square btn-dark text-primary m-1" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 cursor-pointer">
                        &copy; <i class="fa-brands fa-monero M"></i><i class="fa-brands fa-yoast Y"></i><i
                            class="fa-regular fa-copyright C"></i>INEMA, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a class="border-bottom">Hnin Wuttyi</a>
                        <br>Distributed By: <a class="border-bottom" target="_blank">Snow@</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    {{-- Bootstrap Js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('user/lib/wow/wow.min.js') }} "></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }} "></script>
    <script src="{{ asset('user/lib/waypoints/waypoints.min.js') }} "></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }} "></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }} "></script>
    <script>
       function alertMes(){
            alert("You need to login!")
        }
    </script>
</body>
{{-- @yield('script') --}}

</html>

















