<?php

namespace App\Http\Controllers;

use App\Models\Malineacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cprincipal extends Controller
{

    var $key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQSflKxwRJSMeKKF2QT4fwpMeJf36POk6yJVadQssw5c";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $data;

    public function index()
    {
        if (session('sesionUser')) {
            return view('layout.Vprincipal');
        } else {
            return redirect()->intended('/');
        }
    }

    public function getVehiculo(Request $request)
    {
        $r = DB::select("SELECT r.tiporesultado, r.valor, r.observacion, r.idconfig_prueba  FROM vehiculos v, hojatrabajo h, pruebas p, resultados r
                            WHERE v.idvehiculo = h.idvehiculo AND h.idhojapruebas = p.idhojapruebas AND p.idprueba = r.idprueba AND 
                            p.idtipo_prueba = " . $request->input('idtipo_prueba') . " AND v.numero_placa = '" . $request->input('placa') . "' AND p.estado = 2  ORDER BY h.idhojapruebas DESC ");
        // $r = DB::select("SELECT r.* FROM vehiculos v, hojatrabajo h, pruebas p, resultados r
        // WHERE v.idvehiculo = h.idvehiculo AND h.idhojapruebas = p.idhojapruebas AND p.idprueba = r.idprueba AND 
        // p.idtipo_prueba = 10 AND v.numero_placa = 'aaa001' AND p.estado = 2  ORDER BY h.idhojapruebas DESC");

        //var_dump($r);
        echo json_encode($r);
    }

    public function eventosindra(Request $request)
    {
        date_default_timezone_set('America/bogota');
        $date = date("Y-m-d H:i:s");
        $datos = DB::select("SELECT c.valor,
                        (SELECT p.idmaquina FROM vehiculos v, hojatrabajo h, pruebas p
                        WHERE v.idvehiculo= h.idvehiculo AND h.idhojapruebas=p.idhojapruebas AND p.idtipo_prueba=" . $request->input('tipoprueba') . " AND v.tipo_vehiculo = " . $request->input('tipovehiculo') . " ORDER BY 1 DESC LIMIT 1) AS 'idmaquina'
                        FROM config_prueba c
                        WHERE
                        c.idconfiguracion=34 AND c.descripcion LIKE '%runt%' ");
        $maquina = strval($datos[0]->idmaquina);
        if ($maquina == null || $maquina == "")
            $maquina = 3;
        $r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" . $maquina . " LIMIT 1");
        if ($r == null || $r == "" || count($r) == 0)
            $serial = '51553358';
        else
            $serial = $r[0]->serial;
        $cadenasicov = "862|" . $date . "|" . $request->input('prueba') . "|" . $request->input('placa') . "|" . $serial . "|" . $request->input('tipoevento') . "|" . $datos[0]->valor;
        DB::insert("INSERT INTO eventosindra VALUES (NULL,'" . $request->input('placa') . '-' . $request->input('prueba') . "','" . $cadenasicov . "','" . $date . "','e',0,'Operación pendiente')");

        echo json_encode(1);
        //$r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" + $datos[0]->idmaquina + " LIMIT 1");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    public function getResultados() {}

    public function encriptaResult() {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
