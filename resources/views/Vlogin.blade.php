<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <title>Login</title>
</head>

<body style="background-color: blue">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form id="formLogin">
                                {{-- <form action="{{ url('/') }}" method="POST"> --}}
                                    @csrf
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Error</h4>
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <h2 class="fw-bold mb-2 text-uppercase">Bienvenido</h2>
                                    <p class="text-white-50 mb-5">Por favor ingrese su usuario y contraseña</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" name="email"
                                            class="form-control form-control-lg" value="{{ old('email') }}" />
                                        <label class="form-label" for="typeEmailX">Email</label><br>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" name="password"
                                            class="form-control form-control-lg" value="{{ old('password') }}" />
                                        <label class="form-label" for="typePasswordX">Password</label><br>
                                        @if ($errors->has('password'))
                                            <span class="error text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                        id="btn-login">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/data/restric.js') }}?v={{ time() }}"></script>

<script>
    $(document).ready(function() {

        // getClimatico();
    })


    // var th = new Object();
    // var getClimatico = function() {
    //     th.conectado = '1';
    //     setInterval(function() {
    //         var onSuccess = function(position) {
    //             var Latitude = position.coords.latitude;
    //             var Longitude = position.coords.longitude;
    //             //            console.log(position);
    //             getWeather(Latitude, Longitude);
    //         };

    //         function onError(error) {
    //             // alert('code: ' + error.code + '\n' +
    //             //     'message: ' + error.message + '\n');
    //         }
    //         navigator.geolocation.getCurrentPosition(onSuccess, onError);
    //     }, 5000);
    // };

    // function getWeather(latitude, longitude) {
    //     var OpenWeatherAppKey = "8fe69ead09baa9ed61212107194f0bc4";
    //     var queryString =
    //         'http://api.openweathermap.org/data/2.5/weather?lat=' +
    //         latitude + '&lon=' + longitude + '&appid=' + OpenWeatherAppKey + '&units=metric';
    //     $.getJSON(queryString, function(results) {
    //         if (results.weather.length) {
    //             $.getJSON(queryString, function(results) {
    //                 if (results.weather.length) {
    //                     if (parseInt(results.main.humidity) > 90)
    //                         th.humedad = getRandomArbitraryTH(86, 89);
    //                     else if (parseInt(results.main.humidity) < 30)
    //                         th.humedad = getRandomArbitraryTH(31, 34);
    //                     else
    //                         th.humedad = Math.round(results.main.humidity);

    //                     if (parseInt(results.main.temp) < 5)
    //                         th.temp = getRandomArbitraryTH(6, 9);
    //                     else
    //                         th.temp = Math.round(results.main.temp);
    //                     // th.conectado = '1';

    //                     console.log(th);
    //                     //                    console.log(results);
    //                     //                    console.log(th);
    //                     //                    $('#description').text(results.name);
    //                     //                    $('#temp').text(results.main.temp);
    //                     //                    $('#wind').text(results.wind.speed);
    //                     //                    $('#humidity').text(results.main.humidity);
    //                     //                    $('#visibility').text(results.weather[0].main);
    //                     //                    var sunriseDate = new Date(results.sys.sunrise);
    //                     //                    $('#sunrise').text(sunriseDate.toLocaleTimeString());
    //                     //                    var sunsetDate = new Date(results.sys.sunrise);
    //                     //                    $('#sunset').text(sunsetDate.toLocaleTimeString());
    //                 }
    //             });
    //         }
    //     }).fail(function() {
    //         console.log("error getting location");
    //     });
    // }

    // function getRandomArbitraryTH(min, max) {
    //     return Math.round(Math.random() * (max - min) + min);
    // }
    // // Error callback

    // function onWeatherError(error) {
    //     console.log('code: ' + error.code + '\n' +
    //         'message: ' + error.message + '\n');
    // }
</script>
