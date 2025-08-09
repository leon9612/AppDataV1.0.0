<?php

namespace App\Http\Controllers;

use App\Models\Malineacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copacidad extends Controller
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
        (h.reinspeccion = 0 or h.reinspeccion =1 or h.reinspeccion =4444 or h.reinspeccion =44441) and p.idtipo_prueba=2 and p.estado = 0 and
        date_format(p.fechainicial, '%y-%m-%d') = date_format(curdate(), '%y-%m-%d') and (v.tipo_vehiculo = 1 or v.tipo_vehiculo=2) order by p.fechainicial asc ");
            $data['usuarios'] = DB::select("select u.IdUsuario, concat(u.nombres,' ',u.apellidos ) as 'nombre' from usuarios u where u.idperfil = 2 and u.estado = 1");
            $data['maquinas'] = DB::select("select  m.idmaquina, concat(m.nombre, ' ', m.marca, ' ', m.serie) as 'maquina' from maquina m where m.estado = 1 and m.idtipo_prueba = 2 ");
            //$data['placas'] = Malineacion::paginate(5);
            return view('TipoPrueba.opacidad', $data);
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
            'opa1' => 'required',
            'opa2' => 'required',
            'opa3' => 'required',
            'opa4' => 'required',
            'opa1k' => 'required',
            'opa2k' => 'required',
            'opa3k' => 'required',
            'opa4k' => 'required',
            'Rpm_gobernada' => 'required',
            'Rpm_ralenti' => 'required',
            'ltoe' => 'required',
            'idprueba' => 'required',
            'selEstado' => 'required',
            'selUsuario' => 'required',
            'selMaquina' => 'required',
        ]);
        date_default_timezone_set('America/bogota');
        $now = date("Y-m-d H:i:s");
        //$now = date('Y-m-d H:i:s'); //Fomat Date and time
        //insert version software
        $temp = rand(50, 60);
        $opaTotal = request()->input('opa2') + request()->input('opa3') + request()->input('opa4');
        $opafinal = round($opaTotal / 3, 2);
        $opaTotalK = request()->input('opa2k') + request()->input('opa3k') + request()->input('opa4k');
        $opafinalK = round($opaTotalK / 3, 2);
        $rpm1 = rand(request()->input('Rpm_gobernada') + 80, request()->input('Rpm_gobernada'));
        $rpm2 = rand(request()->input('Rpm_gobernada') + 80, request()->input('Rpm_gobernada'));
        $rpm3 = rand(request()->input('Rpm_gobernada') + 80, request()->input('Rpm_gobernada'));
        $rpm4 = rand(request()->input('Rpm_gobernada') + 80, request()->input('Rpm_gobernada'));
        //        $temR = DB::select("select IFNULL((SELECT c.parametro FROM config_maquina c WHERE c.tipo_parametro = 'Temperatura Ambiente' LIMIT 1),'18.9') AS 'val'");
        //        $ranTemp = $temR[0]->val;
        //        $humR = DB::select("select IFNULL((SELECT c.parametro FROM config_maquina c WHERE c.tipo_parametro = 'Humedad Relativa' LIMIT 1),'68.9') AS 'val'");
        //        $ranHum = $humR[0]->val;
        $temR = DB::select("select IFNULL((SELECT c.parametro FROM config_maquina c WHERE c.tipo_parametro = 'Temperatura Ambiente' LIMIT 1),'18.9') AS 'val'");
        $ranTemp = $temR[0]->val;
        if ($ranTemp == 0 || $ranTemp == '0') {
            $ranTemp = rand(16 * 10, 17 * 10) / 10;
        }

        $humR = DB::select("select IFNULL((SELECT c.parametro FROM config_maquina c WHERE c.tipo_parametro = 'Humedad Relativa' LIMIT 1),'68.9') AS 'val'");
        $ranHum = $humR[0]->val;
        if ($ranHum == 0 || $ranHum == 0) {
            $ranHum = rand(68 * 10, 70 * 10) / 10;
        }
        $temRand = rand(50, 70);
        $temFinal = rand($temRand, $temRand + 5);
        if (versionAplicaction() == 1) {
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'defecto', '' , '" . $now . "', 'APROBADA INSPECCION VISUAL', '33', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'defecto', '', $now, 'APROBADA INSPECCION VISUAL', '33') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo1', '" . request()->input('opa1') . "' , '" . $now . "', 'op_ciclo1', '34', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo1', request()->input('opa1'), $now, 'op_ciclo1', '34') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo2', '" . request()->input('opa2') . "' , '" . $now . "', 'op_ciclo2', '35', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo2', request()->input('opa2'), $now, 'op_ciclo2', '35') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo3', '" . request()->input('opa3') . "' , '" . $now . "', 'op_ciclo3', '36', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo3', request()->input('opa3'), $now, 'op_ciclo3', '36') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo4', '" . request()->input('opa4') . "' , '" . $now . "', 'op_ciclo4', '37', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo4', request()->input('opa4'), $now, 'op_ciclo4', '37') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo1K', '" . request()->input('opa1k') . "' , '" . $now . "', 'op_ciclo1K', '501', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo1K', request()->input('opa1k'), $now, 'op_ciclo1K', '501') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo2K', '" . request()->input('opa2k') . "' , '" . $now . "', 'op_ciclo2K', '502', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo2K', request()->input('opa2k'), $now, 'op_ciclo2K', '502') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo3K', '" . request()->input('opa3k') . "' , '" . $now . "', 'op_ciclo3K', '503', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo3K', request()->input('opa3k'), $now, 'op_ciclo3K', '503') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo4K', '" . request()->input('opa4k') . "' , '" . $now . "', 'op_ciclo4K', '504', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo4K', request()->input('opa4k'), $now, 'op_ciclo4K', '504') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_gobernada', '" . request()->input('Rpm_gobernada') . "' , '" . $now . "', 'rpm_gobernada', '41', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_gobernada', request()->input('Rpm_gobernada'), $now, 'rpm_gobernada', '41') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ralenti', '" . request()->input('Rpm_ralenti') . "' , '" . $now . "', 'rpm_ralenti', '38', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ralenti', request()->input('Rpm_ralenti'), $now, 'rpm_ralenti', '38') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'opacidad_total', '" . $opafinal . "' , '" . $now . "', 'opacidad_total', '61', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'opacidad_total', $opafinal, $now, 'opacidad_total', '61') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'opacidad_totalK', '" . $opafinalK . "' , '" . $now . "', 'opacidad_totalK', '505', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'opacidad_totalK', $opafinalK, $now, 'opacidad_totalK', '505') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo1', '" . $rpm1 . "' , '" . $now . "', 'rpm_ciclo1', '62', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo1', $rpm1, $now, 'rpm_ciclo1', '62') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo2', '" . $rpm2 . "' , '" . $now . "', 'rpm_ciclo2', '63', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo2', $rpm2, $now, 'rpm_ciclo2', '63') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo3', '" . $rpm3 . "' , '" . $now . "', 'rpm_ciclo3', '64', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo3', $rpm3, $now, 'rpm_ciclo3', '64') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo4', '" . $rpm4 . "' , '" . $now . "', 'rpm_ciclo4', '65', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo4', $rpm4, $now, 'rpm_ciclo4', '65') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temperatura_ambiente', '" . $ranTemp . "' , '" . $now . "', 'temperatura_ambiente', '200', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temperatura_ambiente', $ranTemp, $now, 'temperatura_ambiente', '200') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'humedad', '" . $ranHum . "' , '" . $now . "', 'humedad', '201', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'humedad', $ranHum, $now, 'humedad', '201') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temp_inicial', '" . $temRand . "' , '" . $now . "', 'temp_inicial', '224', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temp_inicial', $temRand, $now, 'temp_inicial', '224') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temp_final', '" . $temFinal . "' , '" . $now . "', 'temp_final', '39', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temp_final', $temFinal, $now, 'temp_final', '39') . "','" . $this->key . "'))");
        } else {
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo2', '" . request()->input('opa2') . "' , '" . $now . "', 'op_ciclo2', '35', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo2', request()->input('opa2'), $now, 'op_ciclo2', '35') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo3', '" . request()->input('opa3') . "' , '" . $now . "', 'op_ciclo3', '36', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo3', request()->input('opa3'), $now, 'op_ciclo3', '36') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo4', '" . request()->input('opa4') . "' , '" . $now . "', 'op_ciclo4', '37', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo4', request()->input('opa4'), $now, 'op_ciclo4', '37') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo1K', '" . request()->input('opa1k') . "' , '" . $now . "', 'op_ciclo1K', '501', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo1K', request()->input('opa1k'), $now, 'op_ciclo1K', '501') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo2K', '" . request()->input('opa2k') . "' , '" . $now . "', 'op_ciclo2K', '502', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo2K', request()->input('opa2k'), $now, 'op_ciclo2K', '502') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo3K', '" . request()->input('opa3k') . "' , '" . $now . "', 'op_ciclo3K', '503', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo3K', request()->input('opa3k'), $now, 'op_ciclo3K', '503') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo4K', '" . request()->input('opa4k') . "' , '" . $now . "', 'op_ciclo4K', '504', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo4K', request()->input('opa4k'), $now, 'op_ciclo4K', '504') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'opacidad_total', '" . $opafinal . "' , '" . $now . "', 'opacidad_total', '61', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'opacidad_total', $opafinal, $now, 'opacidad_total', '61') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_gobernada', '" . request()->input('Rpm_gobernada') . "' , '" . $now . "', 'rpm_gobernada', '41', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_gobernada', request()->input('Rpm_gobernada'), $now, 'rpm_gobernada', '41') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo1', '" . $rpm1 . "' , '" . $now . "', 'rpm_ciclo1', '62', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo1', $rpm1, $now, 'rpm_ciclo1', '62') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo2', '" . $rpm2 . "' , '" . $now . "', 'rpm_ciclo2', '63', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo2', $rpm2, $now, 'rpm_ciclo2', '63') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo3', '" . $rpm3 . "' , '" . $now . "', 'rpm_ciclo3', '64', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo3', $rpm3, $now, 'rpm_ciclo3', '64') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ciclo4', '" . $rpm4 . "' , '" . $now . "', 'rpm_ciclo4', '65', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ciclo4', $rpm4, $now, 'rpm_ciclo4', '65') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'rpm_ralenti', '" . request()->input('Rpm_ralenti') . "' , '" . $now . "', 'rpm_ralenti', '38', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'rpm_ralenti', request()->input('Rpm_ralenti'), $now, 'rpm_ralenti', '38') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temp_inicial', '" . $temRand . "' , '" . $now . "', 'temp_inicial', '224', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temp_inicial', $temRand, $now, 'temp_inicial', '224') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temp_final', '" . $temFinal . "' , '" . $now . "', 'temp_final', '39', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temp_final', $temFinal, $now, 'temp_final', '39') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'temp_ambiente', '" . $ranTemp . "' , '" . $now . "', 'temp_ambiente', '200', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'temp_ambiente', $ranTemp, $now, 'temp_ambiente', '200') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'humedad', '" . $ranHum . "' , '" . $now . "', 'humedad', '201', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'humedad', $ranHum, $now, 'humedad', '201') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'op_ciclo1', '" . request()->input('opa1') . "' , '" . $now . "', 'op_ciclo1', '34', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'op_ciclo1', request()->input('opa1'), $now, 'op_ciclo1', '34') . "','" . $this->key . "'))");
            DB::insert("INSERT INTO resultados VALUES (NULL, " . request()->input('idprueba') . " , 'opacidad_totalK', '" . $opafinalK . "' , '" . $now . "', 'opacidad_totalK', '505', AES_ENCRYPT('" . $this->encr(request()->input('idprueba'), 'opacidad_totalK', $opafinalK, $now, 'opacidad_totalK', '505') . "','" . $this->key . "'))");
        }
        //        DB::table('vehiculos')
        //                ->where('numero_placa', request()->input('placa'))
        //                ->update([
        //                    'diametro_escape' => request()->input('ltoe')]);
        DB::update("UPDATE vehiculos v set v.diametro_escape = '" . request()->input('ltoe') . "' where v.numero_placa = '" . request()->input('Vplaca') . "'  ");
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
                        WHERE v.idvehiculo= h.idvehiculo AND h.idhojapruebas=p.idhojapruebas AND p.idtipo_prueba=2 AND v.tipo_vehiculo = 1 ORDER BY 1 DESC LIMIT 1) AS 'idmaquina'
                        FROM config_prueba c
                        WHERE
                        c.idconfiguracion=34 AND c.descripcion LIKE '%runt%' ");
        $r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" . strval($datos[0]->idmaquina) . " LIMIT 1");
        if ($r == null || $r == "" || count($r) == 0)
            $serial = '51553358';
        else
            $serial = $r[0]->serial;
        $cadenasicov = "862|" . $date . "|Gases|" . $placa . "|" . $serial . "|2|" . $datos[0]->valor;
        DB::insert("INSERT INTO eventosindra VALUES (NULL,'" . $placa . "-Opacidad','" . $cadenasicov . "','" . $date . "','e',0,'Operación pendiente')");
        //$r = DB::select("SELECT valor AS 'serial' from config_prueba where idconfig_prueba=20000+" + $datos[0]->idmaquina + " LIMIT 1");
    }

    public function encr($idprueba, $tiporesultado, $valor, $fechaguardado, $observacion, $idconfig_prueba)
    {
        $dat['idprueba'] = $idprueba;
        $dat['tiporesultado'] = $tiporesultado;
        $dat['valor'] = "$valor";
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
        $dat['idtipo_prueba'] = "2";
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
