<?php

namespace App\Http\Controllers;

use App\Models\Malineacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;

class Cvisual extends Controller
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
            // var_dump(json_decode(utf8_encode(file_get_contents('https://appdataingeniersoftware.com/defectos.json', true))));
            $data['placas'] = DB::select("SELECT p.*, v.numero_placa as 'placa' 
FROM vehiculos v, hojatrabajo h, pruebas p 
WHERE v.idvehiculo = h.idvehiculo 
AND h.idhojapruebas = p.idhojapruebas 
AND (h.reinspeccion = 0 OR h.reinspeccion = 1 OR h.reinspeccion = 4444 OR h.reinspeccion = 44441) 
AND p.idtipo_prueba = 8 
AND (p.estado = 0 OR p.estado = 2 OR p.estado = 1) 
AND h.estadototal <> 4 
AND h.estadototal <> 7
AND NOT (h.estadototal = 2 AND (h.reinspeccion = 4444 OR h.reinspeccion = 44441))
AND DATE_FORMAT(p.fechainicial, '%y-%m-%d') = DATE_FORMAT(CURDATE(), '%y-%m-%d')  
ORDER BY p.fechainicial ASC");


            $data['usuarios'] = DB::select("select u.IdUsuario, concat(u.nombres,' ',u.apellidos ) as 'nombre' from usuarios u where u.idperfil = 2 and u.estado = 1");
            $data['maquinas'] = DB::select("select  m.idmaquina, concat(m.nombre, ' ', m.marca, ' ', m.serie) as 'maquina' from maquina m where m.estado = 1 and m.idtipo_prueba = 8 and (m.idbanco = 1 or m.idbanco = 2) ");
            //$data['placas'] = Malineacion::paginate(5);
            return view('TipoPrueba.visual', $data);
        } else {
            return redirect()->intended('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDefectos(Request $request)
    {
        $defectos = json_decode(utf8_encode(file_get_contents('https://appdataingeniersoftware.com/defectos.json', true)), true);
        $resultados = DB::select("SELECT  r.idresultados, r.tiporesultado, r.valor, r.fechaguardado, r.observacion, r.idconfig_prueba FROM resultados r WHERE   r.idprueba = " . $request->input('idprueba') . "");
        foreach ($resultados as $resultado) {
            $resultVal = explode('-', $resultado->valor)[0];
            foreach ($defectos as $key => $defecto) {
                if ($defecto['codigo'] == $resultVal) {
                    $resultado->tipo = $defecto['tipo'];
                    $resultado->descripcion = $defecto['descripcion'];

                    break;
                }
            }
        }
        $data['resultados'] = $resultados;
        $data['defectos'] = $defectos;
        return response()->json($data);

        // return response()->json($defectos);
        //var_dump($resultados);
        //  echo file_get_contents('https://appdataingeniersoftware.com/defectos.json', true) ;
        //  echo json_encode(file_get_contents('https://appdataingeniersoftware.com/defectos.json', true))  ;
    }

    public function deleteDefectos(Request $request)
    {
        $resultados = DB::select("DELETE FROM resultados WHERE idresultados = " . $request->input('idresultados') . "");
        return response()->json($resultados);
    }

    public function saveDefectos(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        $resultados = DB::select("INSERT INTO resultados  VALUES (NULL," . $request->input('idprueba') . ",'defecto','" . $request->input('defecto') . "',NOW(),'','153',AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'defecto', request()->input('defecto'), $now, '', '153') . "','" . $this->key . "'))");
        return response()->json($resultados);
    }

    public function saveLabrado(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        if ($request->input('idresultados') !== null && $request->input('idresultados') !== 'undefined') {
            if ($request->input('valor') == '' || $request->input('valor') == null) {
                $res = DB::select("DELETE FROM resultados where idresultados = " . $request->input('idresultados') . "");
            }
            $res = DB::select("DELETE FROM resultados where idresultados = " . $request->input('idresultados') . "");
            // $res = DB::select("UPDATE resultados r set r.valor = '" . $request->input('valor') . "', r.fechaguardado = r.fechaguardado, r.enc = AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), $request->input('tiporesultado'), request()->input('valor'), $now, 'OBSERVACIONLABRADO', '96') . "','" . $this->key . "') where r.idresultados = " . $request->input('idresultados') . "");

            $res = DB::select("INSERT INTO resultados  VALUES (NULL," . $request->input('idprueba') . ",'" . $request->input('tiporesultado') . "','" . $request->input('valor') . "',NOW(),'OBSERVACIONLABRADO','96',AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), $request->input('tiporesultado'), request()->input('valor'), $now, 'OBSERVACIONLABRADO', '96') . "','" . $this->key . "'))");
        } else {
            $res = DB::select("INSERT INTO resultados  VALUES (NULL," . $request->input('idprueba') . ",'" . $request->input('tiporesultado') . "','" . $request->input('valor') . "',NOW(),'OBSERVACIONLABRADO','96',AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), $request->input('tiporesultado'), request()->input('valor'), $now, 'OBSERVACIONLABRADO', '96') . "','" . $this->key . "'))");
        }
        return response()->json($res);
    }

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
            'idprueba' => 'required',
            'selEstado' => 'required',
            'selUsuario' => 'required',
            'selMaquina' => 'required',
        ]);
        date_default_timezone_set('America/bogota');
        $now = date("Y-m-d H:i:s");
        //        $now = date('Y-m-d H:i:s'); //Fomat Date and time
        //insert version software


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
                        WHERE v.idvehiculo= h.idvehiculo AND h.idhojapruebas=p.idhojapruebas AND p.idtipo_prueba=7 AND (v.tipo_vehiculo = 1 or v.tipo_vehiculo = 2)  ORDER BY 1 DESC LIMIT 1) AS 'idmaquina'
                        FROM config_prueba c
                        WHERE
                        c.idconfiguracion=34 AND c.descripcion LIKE '%runt%' ");
        $r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" . strval($datos[0]->idmaquina) . " LIMIT 1");
        if ($r == null || $r == "" || count($r) == 0)
            $serial = '515554858';
        else
            $serial = $r[0]->serial;
        $cadenasicov = "862|" . $date . "|Visual|" . $placa . "|" . $serial . "|2|" . $datos[0]->valor;
        DB::insert("INSERT INTO eventosindra VALUES (NULL,'" . $placa . "-Visual','" . $cadenasicov . "','" . $date . "','e',0,'Operación pendiente')");
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
