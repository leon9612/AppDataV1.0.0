@include('layout.heder')

<main id="main">
    <section id="visor" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Luces Motos</h2>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-12 mt-12 mt-lg-12 d-flex align-items-stretch">
                    <form action="{{ url('/lum') }}" method="POST"  class="form-control">
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
                        <div style="margin-top: 15px">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-3" >
                                    <button style="width: 100%; height: 55px;" class="btn btn-outline-primary" id="btn-actuplacas" {{ back() }}>Actualizar placas</button>
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button style="width: 100%; height: 55px; " class="btn btn-outline-success"
                                        id="btn-buscar-placa">Buscar datos</button>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6" style="align-content: center">
                                    <div class="input-group mb-3" style="align-content: center;">
                                        <label class="input-group-text" for="inputGroupSelect01">Seleccionar placa</label>
                                        <select class="form-select selPlaca" id="inputGroupSelect01" style="height: 58px" name="selPlaca">
                                            <option selected>Placas</option>
                                            @foreach ($placas as $placa)
                                            <option value="{{ $placa->idprueba . '-' . $placa->placa }}">{{ $placa->placa }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4" >
                                    <div class="input-group mb-3" >
                                        <div class="form-floating mb-3">
                                            <input type="text" name="Vplaca" class="form-control Vplaca" id="floatingInput"
                                                   placeholder="name@example.com" disabled>
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
                                    <div class="col-sm-12 col-md-2 col-lg-2" >
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
                                        <select class="form-select" id="inputGroupSelect01" name="selUsuario" id="selUsuario">
                                            @foreach ($usuarios as $us)
                                            <option value="{{ $us->IdUsuario }}">{{ $us->nombre }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5" style="align-content: center">
                                    <div class="input-group mb-3" style="align-content: center">
                                        <label class="input-group-text" for="inputGroupSelect01">Maquinas</label>
                                        <select class="form-select" id="inputGroupSelect01" name="selMaquina" id="selMaquina">
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

                            <div class="container" style=" margin-top: 2%; justify-content: center; display: flex ">
                                <div class="row">
                                    <label style="color: rgb(0, 4, 255); font-size: 18px; text-align: center; width: 100%; background-color: lightgoldenrodyellow">DATO LUCES MOTOS</label>
                                    <div style="justify-content: center; display: flex; margin-top: 15px">

                                        <br>
                                        <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                            <div class="input-group mb-3" style="align-content: center">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="baja_derecha" id="baja_derecha" placeholder="1" value="{{ old('baja_derecha') }}">
                                                    <label for="floatingInput">BAJA  1</label>
                                                    @if ($errors->has('baja_derecha'))
                                                    <span class="error text-danger">{{ $errors->first('baja_derecha') }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                            <div class="input-group mb-3" style="align-content: center">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="incli_derecha" id="incli_derecha" placeholder="1" value="{{ old('incli_derecha') }}">
                                                    <label for="floatingInput">INCLI 1</label>
                                                    @if ($errors->has('incli_derecha'))
                                                    <span class="error text-danger">{{ $errors->first('incli_derecha') }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                            <div class="input-group mb-3" style="align-content: center">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="baja_derecha1" id="baja_derecha1" placeholder="1" value="{{ old('baja_derecha1') }}">
                                                    <label for="floatingInput">BAJA 2</label>
                                                    @if ($errors->has('baja_derecha1'))
                                                    <span class="error text-danger">{{ $errors->first('baja_derecha1') }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3" style="align-content: center">
                                            <div class="input-group mb-3" style="align-content: center">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="incli_derecha1" id="incli_derecha1" placeholder="1" value="{{ old('incli_derecha1') }}">
                                                    <label for="floatingInput">INCLI 2</label>
                                                    @if ($errors->has('incli_derecha1'))
                                                    <span class="error text-danger">{{ $errors->first('incli_derecha1') }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>




                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div style="text-align: center">
                                <button style="height: 55px; width: 150px" class="btn btn-outline-success" type="submit">Guardar</button>

                            </div>
                        </div>
                    </form>
                </div>
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
    $(".selPlaca").change(function (e) {
        e.preventDefault();
        var placa = $('.selPlaca option:selected').attr('value');
        var placa2 = placa.split("-");
        $(".Vplaca").val(placa2[1]);
        $("#placa").val(placa2[1]);
        $("#idprueba").val(placa2[0]);

    });

    $('#sum_bajas').change(function () {
        var sumBajas = document.getElementById('sum_bajas').checked;
        if (sumBajas) {
            var totalBajas = 0;
            var bajad = $("#baja_derecha").val() ? $("#baja_derecha").val() : 0;
            var baja1d = $("#baja_derecha_1").val() ? $("#baja_derecha_1").val() : 0;
            var bajai = $("#baja_izquierda").val() ? $("#baja_izquierda").val() : 0;
            var baja1i = $("#baja_izquierda_1").val() ? $("#baja_izquierda_1").val() : 0;
            var totalBajas = (parseFloat(bajad) + parseFloat(bajai) + parseFloat(baja1d) + parseFloat(baja1i));
            var total = $("#intensidad_total").val() ? $("#intensidad_total").val() : 0;
            var n = parseFloat(total) + parseFloat(totalBajas);
            $("#intensidad_total").val(parseFloat(total) + parseFloat(totalBajas));
            $("#int_total").html("Intensidad total: " + n);
        } else {
            $("#int_total").html("");
            $("#intensidad_total").val("");
            document.getElementById('sum_altas').checked = false;
            document.getElementById('sum-anti').checked = false;
        }
    });

    $('#sum_altas').change(function () {
        var sumAltas = document.getElementById('sum_altas').checked;
        if (sumAltas) {
            var totalALtas = 0;
            var altad = $("#alta_derecha").val() ? $("#alta_derecha").val() : 0;
            var alta1d = $("#alta_derecha_1").val() ? $("#alta_derecha_1").val() : 0;
            var altai = $("#alta_izquierda").val() ? $("#alta_izquierda").val() : 0;
            var alta1i = $("#alta_izquierda_1").val() ? $("#alta_izquierda_1").val() : 0;
            var totalalta = (parseFloat(altad) + parseFloat(altai) + parseFloat(alta1d) + parseFloat(alta1i));
            var total = $("#intensidad_total").val() ? $("#intensidad_total").val() : 0;
            var n = parseFloat(total) + parseFloat(totalalta);
            $("#intensidad_total").val(parseFloat(total) + parseFloat(totalalta));
            $("#int_total").html("Intensidad total: " + n);
        } else {
            $("#int_total").html("");
            $("#intensidad_total").val("");
            document.getElementById('sum_bajas').checked = false;
            document.getElementById('sum-anti').checked = false;
        }
    });

    $('#sum-anti').change(function () {
        var sumAnti = document.getElementById('sum-anti').checked;
        if (sumAnti) {
            var totalanti = 0;
            var antid = $("#anti_derecha").val() ? $("#anti_derecha").val() : 0;
            var anti1d = $("#anti_derecha_1").val() ? $("#anti_derecha_1").val() : 0;
            var antii = $("#anti_izquierda").val() ? $("#anti_izquierda").val() : 0;
            var anti1i = $("#anti_izquierda_1").val() ? $("#anti_izquierda_1").val() : 0;
            var totalanti = (parseFloat(antid) + parseFloat(antii) + parseFloat(anti1d) + parseFloat(anti1i));
            var total = $("#intensidad_total").val() ? $("#intensidad_total").val() : 0;
            var n = parseFloat(total) + parseFloat(totalanti);
            $("#intensidad_total").val(parseFloat(total) + parseFloat(totalanti));
            $("#int_total").html("Intensidad total: " + n);
        } else {
            $("#int_total").html("");
            $("#intensidad_total").val("");
            document.getElementById('sum_bajas').checked = false;
            document.getElementById('sum_altas').checked = false;

        }
    });
    $("#btn-evento").click(function (ev) {
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
                    prueba: 'Luces',
                    tipoprueba: '1',
                    tipovehiculo: '3',
                    tipoevento: '1',
                    _token: $("input[name='_token']").val()},
                success: function (data, textStatus, jqXHR) {
                    Toast.fire({
                        icon: "success",
                        title: "Evento creado, tenga en cuenta el tiempo de duracion de la prueba, para enviar los datos."
                    });

                }, error: function (jqXHR, textStatus, errorThrown) {
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
                    idtipo_prueba: 1,
                    _token: $("input[name='_token']").val()
                },
                success: function(data, textStatus, jqXHR) {
                    if (data.length > 0) {
                        $.each(data, function(i, res) {
                            if (res.observacion == 'baja_izquierda')
                                $("#baja_izquierda").val(res.valor);
                            if (res.observacion == 'inclinacion_izquierda')
                                $("#incli_izquierda").val(res.valor);
                            if (res.observacion == 'alta_izquierda')
                                $("#alta_izquierda").val(res.valor);
                            if (res.observacion == 'baja_derecha')
                                $("#baja_derecha").val(res.valor);
                            if (res.observacion == 'inclinacion_derecha')
                                $("#incli_derecha").val(res.valor);
                            if (res.observacion == 'alta_derecha')
                                $("#alta_derecha").val(res.valor);
                            if (res.observacion == 'antis_derecha')
                                $("#anti_derecha").val(res.valor);
                            if (res.observacion == 'antis_izquierda')
                                $("#anti_izquierda").val(res.valor);
                           


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
</script>