@include('layout.heder')

<main id="main">
    <section id="visor" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Alineación</h2>
            </div>

            <div class="row" data-aos="fade-in">
                <div class="col-lg-12 mt-12 mt-lg-12 d-flex align-items-stretch">
                    <form action="{{ url('/al') }}" method="POST" id="form-datos" class="form-control">
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
                                <button style="width: 100%; height: 55px;" class="btn btn-outline-success"
                                    id="btn-buscar-placa" {{ back() }}>Buscar datos</button>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6" style="align-content: center;">
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

                            <div class="col-sm-12 col-md-4 col-lg-4" style="align-content: center;">
                                <div class="input-group mb-3" style="align-content: center">
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
                                <button style="width: 100%; height: 55px;" class="btn btn-outline-warning"
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
                                    <select class="form-select" id="inputGroupSelect01" name="selMaquina"
                                        id="selMaquina">
                                        @foreach ($maquinas as $ma)
                                            <option value="{{ $ma->idmaquina }}">{{ $ma->maquina }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('selMaquina'))
                                        <span class="error text-danger">{{ $errors->first('selMaquina') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" step="0.01" name="eje1"
                                            id="eje1" placeholder="1" value="{{ old('eje1') }}">
                                        <label for="floatingInput">Eje 1</label>
                                        @if ($errors->has('eje1'))
                                            <span class="error text-danger">{{ $errors->first('eje1') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <div class="form-floating mb-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="2"
                                            name="eje2" id="eje2" value="{{ old('eje2') }}">
                                        <label for="floatingInput">Eje 2</label>
                                        @if ($errors->has('eje2'))
                                            <span class="error text-danger">{{ $errors->first('eje2') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <div class="form-floating mb-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="3"
                                            name="eje3" id="eje3" value="{{ old('eje3') }}">
                                        <label for="floatingInput">Eje 3</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <div class="form-floating mb-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="4"
                                            name="eje4" id="eje4" value="{{ old('eje4') }}">
                                        <label for="floatingInput">Eje 4</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2" style="align-content: center">
                                <div class="input-group mb-3" style="align-content: center">
                                    <div class="form-floating mb-3">
                                        <input type="number" step="0.01" class="form-control" placeholder="5"
                                            name="eje5" id="eje5" value="{{ old('eje5') }}">
                                        <label for="floatingInput">Eje 5</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <button style="width: 100%; height: 55px;" id="btn-guardar"
                                    class="btn btn-outline-success" type="submit">Guardar</button>
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
    $(document).ready(function() {

    })



    $(".selPlaca").change(function(e) {
        e.preventDefault();
        var placa = $('.selPlaca option:selected').attr('value');
        var placa2 = placa.split("-");
        $(".Vplaca").val(placa2[1]);
        $("#placa").val(placa2[1]);
        $("#idprueba").val(placa2[0]);
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
                    idtipo_prueba: 10,
                    _token: $("input[name='_token']").val()
                },
                success: function(data, textStatus, jqXHR) {
                    if (data.length > 0) {
                        $.each(data, function(i, res) {
                            if (res.observacion == 'Alineacion eje 1')
                                $("#eje1").val(res.valor);
                            if (res.observacion == 'Alineacion eje 2')
                                $("#eje2").val(res.valor);
                            if (res.observacion == 'Alineacion eje 3')
                                $("#eje3").val(res.valor);
                            if (res.observacion == 'Alineacion eje 4')
                                $("#eje4").val(res.valor);
                            if (res.observacion == 'Alineacion eje 5')
                                $("#eje5").val(res.valor);
                        });
                    }else{
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
                    prueba: 'Alineacion',
                    tipoprueba: '10',
                    tipovehiculo: '1',
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

    })
</script>
