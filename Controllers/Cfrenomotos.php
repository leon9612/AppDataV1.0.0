<?php

namespace App\Http\Controllers;

use App\Models\Malineacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfrenomotos extends Controller
{

    //    var $key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQSflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c";
    var $key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQSflKxwRJSMeKKF2QT4fwpMeJf36POk6yJVadQssw5c";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('sesionUser') !== "" && session('sesionUser') !== false && session('sesionUser') !== null) {
            $data['placas'] = DB::select("select
        p.idprueba,
        v.numero_placa as 'placa'
        from vehiculos v, hojatrabajo h, pruebas p
        where
        v.idvehiculo = h.idvehiculo and h.idhojapruebas = p.idhojapruebas and
        (h.reinspeccion = 0 or h.reinspeccion =1 or h.reinspeccion =4444 or h.reinspeccion =44441) and p.idtipo_prueba=7 and p.estado = 0 and
        date_format(p.fechainicial, '%y-%m-%d') = date_format(curdate(), '%y-%m-%d') and v.tipo_vehiculo = 3 order by p.fechainicial asc ");
            $data['usuarios'] = DB::select("select u.IdUsuario, concat(u.nombres,' ',u.apellidos ) as 'nombre' from usuarios u where u.idperfil = 2 and u.estado = 1");
            $data['maquinas'] = DB::select("select  m.idmaquina, concat(m.nombre, ' ', m.marca, ' ', m.serie) as 'maquina' from maquina m where m.estado = 1 and m.idtipo_prueba = 7 and m.idbanco = 3");
            //$data['placas'] = Malineacion::paginate(5);
            return view('TipoPrueba.frenomotos', $data);
        } else {
            return redirect()->intended('/');
        }
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
    public function store(Request $request)
    {
        $Mal = new Malineacion();
        $data = request()->except('_token');
        //validacion de campos
        $validated = $request->validate([
            'fuerza1d' => 'required',
            'fuerza1i' => 'required',
            'pesaje1d' => 'required',
            'idprueba' => 'required',
            'selEstado' => 'required',
            'selUsuario' => 'required',
            'selMaquina' => 'required',
        ]);
        date_default_timezone_set('America/bogota');
        $now = date("Y-m-d H:i:s");
        //        $now = date('Y-m-d H:i:s'); //Fomat Date and time
        //insert version software
        if (versionAplicaction() == 1) {
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'Version software', '7.0' , '" . $now . "', 'EasyTecmmas', '100', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'Version software', '7.0', $now, 'EasyTecmmas', '100') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '1', " . request()->input('pesaje1d') . " , '" . $now . "', 'Pesaje eje 1 derecho', '146', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '1', request()->input('pesaje1d'), $now, 'Pesaje eje 1 derecho', '146') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '1', " . request()->input('fuerza1d') . " , '" . $now . "', 'Frenos eje 1 derecho', '148', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '1', request()->input('fuerza1d'), $now, 'Frenos eje 1 derecho', '148') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '2', " . request()->input('fuerza1i') . " , '" . $now . "', 'Frenos eje 2 derecho', '148', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '2', request()->input('fuerza1i'), $now, 'Frenos eje 2 derecho', '148') . "','" . $this->key . "'))");
        } else {
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '1', " . request()->input('fuerza1d') . " , '" . $now . "', 'Frenos eje 1 derecho', '148', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '1', request()->input('fuerza1d'), $now, 'Frenos eje 1 derecho', '148') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '2', " . request()->input('fuerza1i') . " , '" . $now . "', 'Frenos eje 2 derecho', '148', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '2', request()->input('fuerza1i'), $now, 'Frenos eje 2 derecho', '148') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '1', " . request()->input('pesaje1d') . " , '" . $now . "', 'Pesaje eje 1 derecho', '146', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '1', request()->input('pesaje1d'), $now, 'Pesaje eje 1 derecho', '146') . "','" . $this->key . "'))");
            if(request()->input('pesaje2d') !== null && request()->input('pesaje2d') !== "" ){
                DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , '2', " . request()->input('pesaje2d') . " , '" . $now . "', 'Pesaje eje 2 derecho', '146', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), '2', request()->input('pesaje2d'), $now, 'Pesaje eje 2 derecho', '146') . "','" . $this->key . "'))");
            }
        }
        $sumFuerza = floatval(request()->input('fuerza1d')) + floatval(request()->input('fuerza1i'));
        if(request()->input('pesaje2d') !== null && request()->input('pesaje2d') !== "" ){
            $sumPeso = floatval(request()->input('pesaje1d')) + floatval(request()->input('pesaje2d'));
        }else{
            $sumPeso = floatval(request()->input('pesaje1d'));
        }
        $eficaTotal =  ($sumFuerza / $sumPeso);
        $eficaTotal= floatval($eficaTotal * 100);
        DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " ,'eficacia_total', " . $eficaTotal . " , '" . $now . "', 'eficacia_maxima', '151', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'eficacia_total', $eficaTotal, $now, 'eficacia_maxima', '151') . "','" . $this->key . "'))");
        DB::update("UPDATE pruebas p set p.estado = " . request()->input('selEstado') . ", p.idmaquina = " . request()->input('selMaquina') . ", p.idusuario = " . request()->input('selUsuario') . ", p.fechafinal = '" . $now . "' , p.enc = " . "AES_ENCRYPT('" . $this->updateEncr(request()->input('idprueba'), request()->input('selEstado'), request()->input('selMaquina'), request()->input('selUsuario'), $now) . "','" . $this->key . "')" . " where p.idprueba = " . request()->input('idprueba') . "  ");
        if (sicov() == 'INDRA')
            $this->eventosindra(request()->input('placa'));
        return back()->with("succses", "Datos Guardados correctamente");
    }

    public function eventosindra($placa)
    {
        date_default_timezone_set('America/bogota');
        $date = date("Y-m-d H:i:s");
        $datos = DB::select("SELECT c.valor,
                        (SELECT p.idmaquina FROM vehiculos v, hojatrabajo h, pruebas p
                        WHERE v.idvehiculo= h.idvehiculo AND h.idhojapruebas=p.idhojapruebas AND p.idtipo_prueba=7 AND v.tipo_vehiculo = 3  ORDER BY 1 DESC LIMIT 1) AS 'idmaquina'
                        FROM config_prueba c
                        WHERE
                        c.idconfiguracion=34 AND c.descripcion LIKE '%runt%' ");
        $r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" . strval($datos[0]->idmaquina) . " LIMIT 1");
        if ($r == null || $r == "" || count($r) == 0)
            $serial = '51553358';
        else
            $serial = $r[0]->serial;
        $cadenasicov = "862|" . $date . "|Frenos|" . $placa . "|" . $serial . "|2|" . $datos[0]->valor;
        DB::insert("INSERT INTO eventosindra VALUES (NULL,'" . $placa . "-Frenos','" . $cadenasicov . "','" . $date . "','e',0,'Operación pendiente')");
        //$r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" + $datos[0]->idmaquina + " LIMIT 1");
    }

    public function encr($idprueba, $tiporesultado, $valor, $fechaguardado, $observacion, $idconfig_prueba)
    {
        $dat['idprueba'] = $idprueba;
        $dat['tiporesultado'] = $tiporesultado;
        $dat['valor'] = $valor;
        $dat['fechaguardado'] = $fechaguardado;
        $dat['observacion'] = $observacion;
        $dat['idconfig_prueba'] = $idconfig_prueba;
        $enc = json_encode($dat);
        return $enc;
    }

    public function updateEncr($idprueba, $estado, $idmaquina, $idusuario, $fechafinal)
    {
        $res = DB::select("select * from pruebas p where p.idprueba = $idprueba");
        $idhojapruebas = $res[0]->idhojapruebas;
        $dat['idhojapruebas'] = "$idhojapruebas";
        $dat['fechainicial'] = $res[0]->fechainicial;
        $dat['prueba'] = "0";
        $dat['estado'] = $estado;
        $dat['fechafinal'] = $fechafinal;
        $dat['idmaquina'] = $idmaquina;
        $dat['idusuario'] = $idusuario;
        $dat['idtipo_prueba'] = "7";
        $enc = json_encode($dat);
        return $enc;
    }

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
