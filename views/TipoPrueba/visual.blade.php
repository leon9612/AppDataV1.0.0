@include('layout.heder')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<main id="main">
    <section id="visor" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Visual</h2>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-12 mt-12 mt-lg-12 d-flex align-items-stretch">
                    <form action="{{ url('/visual') }}" method="POST" class="form-control">
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
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <button style="width: 100%; height: 55px;" class="btn btn-outline-primary"
                                        id="btn-actuplacas" {{ back() }}>Actualizar placas</button>
                                </div>
                                {{-- <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button style="width: 100%; height: 55px; " class="btn btn-outline-success"
                                        id="btn-buscar-placa">Buscar datos</button>
                                </div> --}}
                                <div class="col-sm-12 col-md-6 col-lg-6" style="align-content: center">
                                    <div class="input-group mb-3" style="align-content: center;">
                                        <label class="input-group-text" for="inputGroupSelect01">Seleccionar
                                            placa</label>
                                        <select class="form-select selPlaca" id="inputGroupSelect01"
                                            style="height: 58px" name="selPlaca">
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
                            </div>
                            <div class="container" style=" margin-top: 2%;  ">
                                <div class="row">
                                    <label
                                        style="color: rgb(0, 4, 255); font-size: 18px; text-align: center; width: 100%; background-color: lightgoldenrodyellow">Labrado
                                        de llantas</label>
                                    <div style="justify-content: left; display: flex; margin-top: 15px">

                                        <br>
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="align-content: left">


                                            <div class="row">
                                                @for ($eje = 1; $eje <= 5; $eje++)
                                                    @php
                                                        // Para eje 1 solo hay dos llantas (izquierda y derecha)
                                                        $llantas =
                                                            $eje == 1
                                                                ? [
                                                                    ['pos' => 'Izquierda', 'tipo' => 'izquierdo'],
                                                                    ['pos' => 'Derecha', 'tipo' => 'derecho'],
                                                                ]
                                                                : [
                                                                    [
                                                                        'pos' => 'izquierda Interna',
                                                                        'tipo' => 'izquierdo_interior',
                                                                    ],
                                                                    [
                                                                        'pos' => 'izquierda Externa',
                                                                        'tipo' => 'izquierdo',
                                                                    ],
                                                                    [
                                                                        'pos' => 'derecha Interna',
                                                                        'tipo' => 'derecho_interior',
                                                                    ],
                                                                    [
                                                                        'pos' => 'derecha Externa',
                                                                        'tipo' => 'derecho',
                                                                    ],
                                                                ];
                                                    @endphp
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="card p-2">
                                                            <strong>Eje {{ $eje }}</strong>
                                                            <div class="row">
                                                                @foreach ($llantas as $llanta)
                                                                    <div class="col-md-3 col-sm-6 mb-2">
                                                                        <label
                                                                            style="font-size: 13px;">{{ $llanta['pos'] }}</label>
                                                                        <div class="input-group input-group-sm">
                                                                            @for ($toma = 0; $toma <= 2; $toma++)
                                                                                @if ($toma == 0)
                                                                                    <input type="number"
                                                                                        step="0.01" min="0"
                                                                                        max="99"
                                                                                        name="Labrado_llanta_eje{{ $eje }}_{{ $llanta['tipo'] }}"
                                                                                        id="Labrado_llanta_eje{{ $eje }}_{{ $llanta['tipo'] }}"
                                                                                        class="form-control labrado-input"
                                                                                        placeholder="Toma {{ $toma }}"
                                                                                        style="width: 33%; font-size: 12px;"
                                                                                        onblur="saveLabrado(this)" />
                                                                                @else
                                                                                    <input type="number"
                                                                                        step="0.01" min="0"
                                                                                        max="99"
                                                                                        name="Labrado_llanta_eje{{ $eje }}_{{ explode('_', $llanta['tipo'])[0] }}{{ $toma }}{{ isset(explode('_', $llanta['tipo'])[1]) ? '_' . explode('_', $llanta['tipo'])[1] : '' }}"
                                                                                        id="Labrado_llanta_eje{{ $eje }}_{{ explode('_', $llanta['tipo'])[0] }}{{ $toma }}{{ isset(explode('_', $llanta['tipo'])[1]) ? '_' . explode('_', $llanta['tipo'])[1] : '' }}"
                                                                                        class="form-control"
                                                                                        placeholder="Toma {{ $toma }}"
                                                                                        style="width: 33%; font-size: 12px;"
                                                                                        onblur="saveLabrado(this)" />
                                                                                @endif
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                                <div class="col-lg-12 mb-2">
                                                    <div class="card p-2">
                                                        <strong>Llanta de repuesto</strong>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 mb-2">
                                                                <label style="font-size: 13px;">Repuesto</label>
                                                                <div class="input-group input-group-sm">
                                                                    @for ($toma = 1; $toma <= 3; $toma++)
                                                                        <input type="number" step="0.01"
                                                                            min="0" max="99"
                                                                            name="labrado_repuesto_t{{ $toma }}"
                                                                            class="form-control"
                                                                            placeholder="Toma {{ $toma }}"
                                                                            style="width: 33%; font-size: 12px;" />
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-sm-12 col-md-4 col-lg-4" style="align-content: left">
                                            <div class="input-group mb-3"
                                                style="align-content: left; margin-left: 10px">
                                                <label class="input-group-text"
                                                    for="inputGroupSelect01">Filtro</label>
                                                <select class="form-select" name="filterSelect" id="filterSelect">
                                                    <option value="all">Todos los campos</option>
                                                    <option value="codigo">Código</option>
                                                    <option value="descripcion">Descripción</option>
                                                    <option value="tipo">Tipo (A/B)</option>
                                                    <option value="nombre_grupo">Grupo</option>
                                                    <option value="nombre_defecto">Categoría</option>
                                                </select>

                                            </div>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style=" margin-top: 2%;  ">
                                    <div class="row">
                                        <label
                                            style="color: rgb(0, 4, 255); font-size: 18px; text-align: center; width: 100%; background-color: lightgoldenrodyellow">Asignar
                                            defectos</label>
                                        <div style="justify-content: left; display: flex; margin-top: 15px">

                                            <br>
                                            <div class="col-sm-12 col-md-6 col-lg-6" style="align-content: left">
                                                <div class="mb-1">
                                                    <select style="height: 20em" class="form-select select2-defectos"
                                                        name="selectDefectos" id="selectDefectos">
                                                        <option></option>
                                                    </select>
                                                </div>

                                            </div>

                                            {{-- <div class="col-sm-12 col-md-4 col-lg-4" style="align-content: left">
                                            <div class="input-group mb-3"
                                                style="align-content: left; margin-left: 10px">
                                                <label class="input-group-text"
                                                    for="inputGroupSelect01">Filtro</label>
                                                <select class="form-select" name="filterSelect" id="filterSelect">
                                                    <option value="all">Todos los campos</option>
                                                    <option value="codigo">Código</option>
                                                    <option value="descripcion">Descripción</option>
                                                    <option value="tipo">Tipo (A/B)</option>
                                                    <option value="nombre_grupo">Grupo</option>
                                                    <option value="nombre_defecto">Categoría</option>
                                                </select>

                                            </div>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="container" style=" margin-top: 2%;  ">
                                    <div class="row">
                                        <label
                                            style="color: rgb(0, 4, 255); font-size: 18px; text-align: center; width: 100%; background-color: lightgoldenrodyellow">Defectos
                                            asignados</label>
                                        <div style="justify-content: left; display: flex; margin-top: 15px">

                                            <br>
                                            <div class="col-sm-12 col-md-12 col-lg-12" style="align-content: left">
                                                <div class="mb-3" style="width: 30%">
                                                    <input type="text" id="searchDefectos" class="form-control"
                                                        placeholder="Buscar en defectos asignados...">
                                                </div>
                                                <br>

                                                <table class="table" id="tableResultsDefectos">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Tipo</th>
                                                            <th>Descripción</th>

                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="resultsDfectos">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align: center">
                                    <button style="height: 55px; width: 150px" class="btn btn-outline-success"
                                        type="submit">Guardar</button>

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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).on('input', '#searchDefectos', function() {
        const search = $(this).val().toLowerCase();
        $("#tableResultsDefectos tbody tr").each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(search));
        });
    });
</script>

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
        $('.select2-defectos').select2({
            placeholder: "Buscar defecto...",
            allowClear: true,
            width: 'resolve',

        });

        $('#selectDefectos').on('select2:select', function(e) {
            const selectedDefect = e.params.data;
            if (selectedDefect.id) {
                addDefectToTable(selectedDefect);
                $(this).val(null).trigger('change'); // Limpiar selección
            }
        });



    });







    $(".selPlaca").change(function(e) {
        e.preventDefault();
        var placa = $('.selPlaca option:selected').attr('value');
        var placa2 = placa.split("-");
        $(".Vplaca").val(placa2[1]);
        $("#placa").val(placa2[1]);
        $("#idprueba").val(placa2[0]);
        Swal.fire({
            title: 'Cargando defectos...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        loadDefects();

    });

    let allDefects = [];
    async function loadDefects() {
        $.ajax({
            url: 'getDefectos/',
            type: 'post',
            dataType: 'json',
            data: {
                idprueba: $("#idprueba").val(),
                _token: $("input[name='_token']").val()
            },
            success: function(data) {
                initializeSelect2(data.defectos);
                $("#tableResultsDefectos tbody").empty();
                if (data.resultados.length == 0) {
                    $("#tableResultsDefectos tbody").append(
                        `<tr>
                            <td colspan="5">No se encontraron defectos</td>
                        </tr>`
                    );
                    Swal.close();
                    return;
                }
                data.resultados.forEach(function(index, value) {
                    // console.log(index);
                    if (index.tiporesultado == 'defecto') {
                        $("#tableResultsDefectos tbody").append(
                            `<tr>
                                <td>${index.valor}</td>
                                <td>${index.tipo}</td>
                                <td>${index.descripcion}</td>
                                
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="event.preventDefault(); removeDefect(${index.idresultados});">Eliminar</button>
                                </td>
                            </tr>`
                        );
                    } else if (index.observacion == "OBSERVACIONLABRADO") {
                        // console.log(index.tiporesultado);
                        $("#" + index.tiporesultado)
                            .val(index.valor)
                            .attr('idresultados', index.idresultados);
                    }
                });

                // Cerrar SweetAlert de carga
                Swal.close();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron cargar los defectos. ' + jqXHR.responseText
                });

            }
        });
    }

    var saveLabrado = function(data) {
        let idresultados = data.getAttribute('idresultados')
        console.log(data.id)
        console.log(data.value)
        $.ajax({
            url: 'saveLabrado/',
            type: 'post',
            dataType: 'json',
            data: {
                idprueba: $("#idprueba").val(),
                idresultados: idresultados,
                tiporesultado: data.id,
                valor: data.value,
                _token: $("input[name='_token']").val()
            },
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Labrado guardado exitosamente, por favor espere a que se actualice la tabla',
                    timer: 4000
                });

                Swal.fire({
                    title: 'Refrescando la tabla',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                loadDefects();


            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron cargar los defectos. ' + jqXHR.responseText
                });
            }
        });
    }








    function initializeSelect2(defects) {
        const defectOptions = defects.map(defect => ({
            id: defect.codigo,
            text: `${defect.codigo} - ${defect.descripcion}`,
            ...defect
        }));

        $('#selectDefectos').select2({
            data: defectOptions,
            placeholder: "Buscar defecto...",
            allowClear: true
        });
    }

    function addDefectToTable(defect) {
        // Verificar si el defecto ya existe en la tabla
        const exists = $("#tableResultsDefectos tbody tr").toArray().some(tr => {
            return $(tr).find('td:first').text() === defect.codigo;
        });

        if (exists) {
            Swal.fire({
                icon: 'warning',
                title: 'Defecto duplicado',
                text: 'Este defecto ya ha sido agregado a la tabla'
            });
            return;
        }

        $.ajax({
            url: 'saveDefectos/',
            type: 'post',
            dataType: 'json',
            data: {
                idprueba: $("#idprueba").val(),
                defecto: defect.codigo,
                _token: $("input[name='_token']").val()
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'El defecto se creó con éxito, por favor espere unos segundos para que se actualice la tabla.',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
                loadDefects();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron crear los defectos. ' + jqXHR.responseText
                });

            }
        });




        //     $("#tableResultsDefectos tbody").append(`
        //     <tr>
        //         <td>${defect.codigo}</td>
        //         <td>${defect.tipo}</td>
        //         <td>${defect.descripcion}</td>
        //         <td><input type="text" class="form-control" placeholder="Observación"></td>
        //         <td>
        //             <button class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()">Eliminar</button>
        //         </td>
        //     </tr>
        // `);
    }

    var removeDefect = function(idresultados) {

        $.ajax({
            url: 'deleteDefectos/',
            type: 'post',
            dataType: 'json',
            data: {
                idresultados: idresultados,
                _token: $("input[name='_token']").val()
            },
            success: function(data) {
                // Limpiar la tabla antes de agregar nuevos resultados
                // $("#tableResultsDefectos tbody").empty();
                Toast.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'El defecto se eliminó correctamente. '
                });

                $("#tableResultsDefectos tbody tr").filter(function() {
                    return $(this).find('button').attr('onclick')?.includes(
                        `removeDefect(${idresultados})`);
                }).remove();
                //loadDefects();

            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron borrar los defectos. ' + jqXHR.responseText
                });

            }
        });
    }


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
                    prueba: 'Visual',
                    tipoprueba: '8',
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
