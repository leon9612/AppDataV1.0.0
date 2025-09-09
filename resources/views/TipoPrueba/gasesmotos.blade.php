@include('layout.heder')
<main id="main">
    <section id="visor" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Gases Motos</h2>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-12 mt-12 mt-lg-12 d-flex align-items-stretch">
                    <form action="{{ url('/gam') }}" method="POST" class="form-control">
                        @csrf
                        @if ($message = Session::get('succses'))
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Exitoso</h4>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Error</h4>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <button style="width: 100%; height: 55px;" class="btn btn-outline-primary"
                                    id="btn-actuplacas" {{ back() }}>Actualizar placas</button>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <button style="width: 100%; height: 55px; " class="btn btn-outline-success"
                                    id="btn-buscar-placa">Buscar datos</button>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center;">
                                    <label class="input-group-text" for="inputGroupSelect01">Seleccionar placa</label>
                                    <select class="form-select selPlaca" id="inputGroupSelect01" style="height: 58px"
                                        name="selPlaca">
                                        <option selected>Placas</option>
                                        @foreach ($placas as $placa)
                                            <option value="{{ $placa->idprueba . '-' . $placa->placa }}">
                                                {{ $placa->placa }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="input-group mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="Vplaca" class="form-control Vplaca"
                                            id="floatingInput" placeholder="name@example.com" disabled>
                                        <input type="hidden" name="idprueba" id="idprueba" class="form-control">
                                        <input type="hidden" name="placa" id="placa" class="form-control">
                                        <label for="floatingInput">Placa seleccionada</label>
                                        @if ($errors->has('idprueba'))
                                            <span class="error text-danger">{{ $errors->first('idprueba') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <?php if (sicov() == 'INDRA') { ?>
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <button style="width: 100%; height: 55px" class="btn btn-outline-warning"
                                    id="btn-evento" {{ back() }}>Evento inicial</button>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                                    <select class="form-select selEstado" id="inputGroupSelect01" name="selEstado">
                                        <option value="2">Aprobado</option>
                                        <option value="1">Rechazadao</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Usuarios</label>
                                    <select class="form-select" id="inputGroupSelect01" name="selUsuario"
                                        id="selUsuario">
                                        @foreach ($usuarios as $us)
                                            <option value="{{ $us->IdUsuario }}">{{ $us->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Maquinas</label>
                                    <select class="form-select" id="selMaquina" name="selMaquina" id="selMaquina">
                                        @foreach ($maquinas as $ma)
                                            <option value="{{ $ma->idmaquina }}">{{ $ma->maquina }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('selMaquina'))
                                        <span class="error text-danger">{{ $errors->first('selMaquina') }}</span>
                                    @endif

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Scooter</label>
                                    <select class="form-select" id="inputGroupSelect01" name="selScooter"
                                        id="selScooter">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                    @if ($errors->has('selScooter'))
                                        <span class="error text-danger">{{ $errors->first('selScooter') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Catalizador</label>
                                    <select class="form-select" id="inputGroupSelect01" name="selCatalizador"
                                        id="selCatalizador">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                    @if ($errors->has('selCatalizador'))
                                        <span class="error text-danger">{{ $errors->first('selCatalizador') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <label class="input-group-text" for="inputGroupSelect01">Motocarro</label>
                                    <select class="form-select" name="selMotocarro" id="selMotocarro">
                                        <option value="0" selected>NO</option>
                                        <option value="1">SI</option>
                                    </select>


                                </div>
                            </div>

                        </div>
                        <div class="container" style="justify-content: center; display: flex ">
                            <div class="row">
                                <label
                                    style="color: rgb(0, 4, 255); font-size: 18px; text-align: center; width: 100%; margin-top: 15px; background-color: lightgoldenrodyellow">DATOS
                                    RALENTI</label>
                                <div style="justify-content: center; display: flex; margin-top: 15px">

                                    <br>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                        <div class="input-group mb-3" style="align-content: center">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="hc_ralenti"
                                                    id="hc_ralenti" placeholder="1" value="{{ old('hc_ralenti') }}">
                                                <label for="floatingInput">HC RALENTI</label>
                                                @if ($errors->has('hc_ralenti'))
                                                    <span
                                                        class="error text-danger">{{ $errors->first('hc_ralenti') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                        <div class="input-group mb-3" style="align-content: center">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" step="0.01"
                                                    name="co_ralenti" id="co_ralenti" placeholder="1"
                                                    value="{{ old('co_ralenti') }}">
                                                <label for="floatingInput">CO RALENTI</label>
                                                @if ($errors->has('co_ralenti'))
                                                    <span
                                                        class="error text-danger">{{ $errors->first('co_ralenti') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                        <div class="input-group mb-3" style="align-content: center">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" step="0.01"
                                                    name="co2_ralenti" id="co2_ralenti" placeholder="1"
                                                    value="{{ old('co2_ralenti') }}">
                                                <label for="floatingInput">CO2 RALENTI</label>
                                                @if ($errors->has('co2_ralenti'))
                                                    <span
                                                        class="error text-danger">{{ $errors->first('co2_ralenti') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                        <div class="input-group mb-3" style="align-content: center">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" step="0.01"
                                                    name="o2_ralenti" id="o2_ralenti" placeholder="1"
                                                    value="{{ old('o2_ralenti') }}">
                                                <label for="floatingInput">O2 RALENTI</label>
                                                @if ($errors->has('o2_ralenti'))
                                                    <span
                                                        class="error text-danger">{{ $errors->first('o2_ralenti') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                        <div class="input-group mb-3" style="align-content: center">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" step="0.01"
                                                    name="rpm_ralenti" id="rpm_ralenti" placeholder="1"
                                                    value="{{ old('rpm_ralenti') }}">
                                                <label for="floatingInput">RPM RALENTI</label>
                                                @if ($errors->has('rpm_ralenti'))
                                                    <span
                                                        class="error text-danger">{{ $errors->first('rpm_ralenti') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center"
                            style="margin-top: 20px; margin-bottom: 20px">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <div class="input-group mb-3">
                                    <div class="form-floating mb-3" style="margin-top: 29px">
                                        <input type="number" class="form-control" step="0.01" name="tempMotor"
                                            id="tempMotor" placeholder="1" value="{{ $tempMotor }}">
                                        <label for="floatingInput">TEMPERATURA MOTOR</label>
                                        @if ($errors->has('tempMotor'))
                                            <span class="error text-danger">{{ $errors->first('tempMotor') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 d-flex align-items-end">
                                <button style="height: 55px; width: 150px" class="btn btn-outline-success"
                                    type="submit">Guardar</button>
                            </div>
                        </div>


                </div>
                </form>
            </div>

        </div>
    </section>
    <!-- ======= Contact Section ======= -->
</main>
@include('layout.footer')
<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    $(document).ready(function() {
        if (localStorage.getItem('motocarro') == '1') {
            $('#selMotocarro').val(localStorage.getItem('motocarro'));
            getMaquina();
        }
    });
    $("#selMotocarro").change(function(e) {
        e.preventDefault();
        let motocarro = $('#selMotocarro option:selected').attr('value');
        localStorage.setItem('motocarro', motocarro);

        getMaquina();

    });

    $(".selPlaca").change(function(e) {
        e.preventDefault();
        var placa = $('.selPlaca option:selected').attr('value');
        var placa2 = placa.split("-");
        $(".Vplaca").val(placa2[1]);
        $("#placa").val(placa2[1]);
        $("#idprueba").val(placa2[0]);
        console.log(placa2);

    });


    $("#btn-evento").click(function(ev) {
        ev.preventDefault();
        if ($(".Vplaca").val() == null || $(".Vplaca").val() == "") {
            Toast.fire({
                icon: "error",
                title: "Seleccione una placa"
            });
        } else {
            $.ajax({
                url: 'getevento/',
                type: 'post',
                dataType: 'json',
                data: {
                    placa: $(".Vplaca").val(),
                    prueba: 'Gases',
                    tipoprueba: '3',
                    tipovehiculo: '3',
                    tipoevento: '1',
                    _token: $("input[name='_token']").val()
                },
                success: function(data, textStatus, jqXHR) {
                    Toast.fire({
                        icon: "success",
                        title: "Evento creado, tenga en cuenta el tiempo de duracion de la prueba, para enviar los datos."
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error')
                    console.log(jqXHR.responseText)
                    console.log(textStatus)
                    console.log(errorThrown)
                }
            });
        }

    });

    $("#btn-buscar-placa").click(function(e) {
        e.preventDefault();

        if ($(".Vplaca").val() == "" || $(".Vplaca").val() == null) {
            Swal.fire({
                icon: "info",
                title: 'Buscar placa',
                allowOutsideClick: false,
                html: '<div style= "font-size: 18px">Seleccione una placa primero<div>',
                showConfirmButton: true,
            });
        } else {
            $.ajax({
                url: 'buscarvehiculo/',
                type: 'post',
                dataType: 'json',
                data: {
                    placa: $(".Vplaca").val(),
                    idtipo_prueba: 3,
                    _token: $("input[name='_token']").val()
                },
                success: function(data, textStatus, jqXHR) {
                    if (data.length > 0) {
                        $.each(data, function(i, res) {

                            if (res.observacion == 'hc_ralenti')
                                $("#hc_ralenti").val(res.valor);
                            if (res.observacion == 'rpm_ralenti')
                                $("#rpm_ralenti").val(res.valor);
                            if (res.observacion == 'co_ralenti')
                                $("#co_ralenti").val(res.valor);
                            if (res.observacion == 'co2_ralenti')
                                $("#co2_ralenti").val(res.valor);
                            if (res.observacion == 'o2_ralenti')
                                $("#o2_ralenti").val(res.valor);


                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "No se encontraron registros."
                        });
                    }



                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('error')
                    console.log(jqXHR.responseText)
                    console.log(textStatus)
                    console.log(errorThrown)
                }
            });
        }
    })

    var getMaquina = function() {
        $.ajax({
            url: 'getMaquina/',
            type: 'post',
            dataType: 'json',
            data: {
                idtipo_prueba: 3,
                motocarro: $('#selMotocarro').val(),
                _token: $("input[name='_token']").val()
            },
            success: function(data, textStatus, jqXHR) {
                if (data.length > 0) {
                    $('#selMaquina').empty();
                    // $('.selMaquina').append('<option value="">Seleccione una maquina</option>');
                    $.each(data, function(i, res) {
                        $('#selMaquina').append('<option value="' + res.idmaquina + '">' + res
                            .maquina +
                            '</option>');
                    });
                } else {
                    Toast.fire({
                        icon: "error",
                        title: "No se encontraron maquinas."
                    });
                }



            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('error')
                console.log(jqXHR.responseText)
                console.log(textStatus)
                console.log(errorThrown)
            }
        });
    }
</script>
