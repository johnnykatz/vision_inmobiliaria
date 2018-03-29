<?php


namespace App\Services;

use App\Models\Admin\Landing;
use App\Models\Admin\LandingsEnviadosXServicio;
use App\Models\Admin\ServicioCrm;
use App\Models\Admin\ServiciosCrmsXLanding;
use App\Providers\FuncionesProvider;
use FacebookAds\Exception\Exception;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

use DB;
use Log;

class LandingsService
{

    public function __construct($servicio)
    {
        $this->servicio = $servicio = ServicioCrm::where('slug', trim($servicio))
            ->where('estado', true)->first();
    }

    public function sincronizarEstructura()
    {

        $landings = Landing::where('activo', true)->where('con_estructura', false)->get();

        foreach ($landings as $landing) {

            $url = $landing->endpoint;
            $response = json_decode(file_get_contents($url), true);

            if (count($response['data']) > 0) {
                $record = $response['data'][0];

                \Illuminate\Support\Facades\DB::transaction(function () use ($landing, $record) {
                    $campos = array_diff(array_keys($record), [$landing->landing_identificador, $landing->campo_fecha]);

                    $dbName = 'landing_' . uniqid();

                    // Crear tabla para el landing
                    \Illuminate\Support\Facades\Schema::create($dbName, function (\Illuminate\Database\Schema\Blueprint $table) use ($campos) {
                        $table->string('id');
                        $table->string('landing_identificador');
                        $table->string('fecha_creacion');
                        $table->string('Nombredeformulario');
                        $table->string('canal_sistema');
                        $table->boolean('habeas_sistema')->default(true);
                        $table->boolean('terminos_sistema')->default(true);

                        foreach ($campos as $campo) {
                            $table->string(\App\Providers\FuncionesProvider::limpiaCadena($campo));
                        }

                        $table->timestamps();
                    });

                    // Actulizar el landing
                    $landing->db_name = $dbName;
                    $landing->con_estructura = true;
                    $landing->save();

                });
            }
        }

    }

    public function obtenerDatos()
    {

        $serviciosCrmsXLandings = ServiciosCrmsXLanding::where('servicios_crm_id', $this->servicio->id)->get();

        if (count($serviciosCrmsXLandings) > 0) {
            foreach ($serviciosCrmsXLandings as $serviciosCrmsXLanding) {

                $landing = $serviciosCrmsXLanding->landing;

                if ($landing->con_estructura && $landing->activo) {

                    $campos = DB::select('SELECT COLUMN_NAME
                          FROM INFORMATION_SCHEMA.COLUMNS
                          WHERE table_name ="' . $landing->db_name . '"');
                    $arrayCampos = array();

                    foreach ($campos as $campo) {
                        $arrayCampos[$campo->COLUMN_NAME] = $campo->COLUMN_NAME;
                    }

                    echo 'Landing -> ' . $landing->nombre . "\n";

                    $url = $landing->endpoint . '?fecha=' . strtotime($landing->fecha_ultimo_registro);
                    $response = json_decode(file_get_contents($url), TRUE);

                    if (is_array($response['data']) && count($response['data']) > 0) {
	                    $countData = count($response['data']);
	                    $i = 0;
                        foreach ($response['data'] as $data) {

                            $landing_tmp = DB::table($landing->db_name)
                                ->select('id')
                                ->where('landing_identificador', $data[$landing->landing_identificador])
                                ->first();
                            if ($landing_tmp) {
                                continue;
                            }

                            $fields = array();
                            $values = array();

                            $fields[] = 'id';
                            $values[] = uniqid();

                            $fields[] = 'landing_identificador';
                            $values[] = $data[$landing->landing_identificador];

                            $fields[] = 'Nombredeformulario';
                            $values[] = $landing->nombre;

                            $fields[] = 'canal_sistema';
                            $values[] = $landing->canal;

                            $fields[] = 'fecha_creacion';
                            $values[] = $data[$landing->campo_fecha];

                            $fields[] = 'created_at';
                            $values[] = date("Y-m-d H:i:s");

                            $fields[] = 'updated_at';
                            $values[] = date("Y-m-d H:i:s");

                            foreach (array_except($data, [$landing->landing_identificador]) as $k => $val) {
                                if (in_array(FuncionesProvider::limpiaCadena($k), $arrayCampos)) {
                                    $fields[] = FuncionesProvider::limpiaCadena($k);
                                    $values[] = addslashes(utf8_decode((string)$val));
                                }
                            }

                            $valores = "'" . implode("','", $values) . "'";

                            $sql = DB::insert("insert into " . $landing->db_name . " (" . implode(',', $fields) . ")" . " values (" . $valores . ")");

	                        // Guardar fecha del ultimo registro
	                        if(++$i == $countData) {
                                $landing->fecha_ultimo_registro = $data[$landing->campo_fecha];
	                        }
                        }

                        $landing->fecha_sincronizacion = date("Y-m-d H:i:s");
                        $landing->save();
                    }
                }
            }
        }

    }


    public function enviarDatos()
    {
        $serviciosCrmsXLandings = ServiciosCrmsXLanding::where('servicios_crm_id', $this->servicio->id)->get();

        if (count($serviciosCrmsXLandings) > 0) {
            foreach ($serviciosCrmsXLandings as $serviciosCrmsXLanding) {

                $landing = $serviciosCrmsXLanding->landing;

                if ($landing->activo == false) {
                    continue;
                }

                $campos = DB::table('campos_servicios_crms as c')
                    ->join('landings_campos_servicios as a', 'a.campos_servicios_crm_id', '=', 'c.id')
                    ->where('c.servicio_crm_id', '=', $this->servicio->id)
                    ->where('a.landing_id', '=', $landing->id)
                    ->where('c.estado', true)
                    ->select('c.nombre as campo_crm', 'a.campo_formulario', 'c.requerido', 'c.tipo', 'codifica')
                    ->get();

                $estructura = array();
                $requeridos = array();

                foreach ($campos as $campo) {
                    $estructura[$campo->campo_formulario] = $campo->campo_crm;
                    $requeridos[$campo->campo_formulario] = $campo->requerido;
                    $tipos[$campo->campo_formulario] = $campo->tipo;
                    $codifica[$campo->campo_formulario] = $campo->codifica;
                }

                $datosFormulario = DB::select('SELECT form.*
                          FROM ' . $landing->db_name . ' as form
                          LEFT JOIN landings_enviados_x_servicios as fe on fe.registro_id=form.id
                         where fe.registro_id is null');

                if (count($datosFormulario) > 0) {
                    foreach ($datosFormulario as $dato) {
                        $datosAEnviar = null;
                        $estadoDatos = true;
                        $dato = (array)$dato;

                        foreach ($estructura as $key => $campo) {

                            if ($key != "") {
                                //si tiene datos pregunto el tipo para pasarle el correcto
                                if ($tipos[$key] == 'numeric') {
                                    $datoTmp = preg_replace(sprintf('~[^%s]++~i', '0-9'), '', $dato[$key]);
                                    if (isset($datoTmp) and is_numeric($datoTmp)) {
                                        $datosAEnviar .= "&" . $campo . "=" . $datoTmp;
                                    } else {
                                        if (isset($requeridos[$key]) and $requeridos[$key] == 1) {
                                            //si no esta vacio y es requerido cancelo el leads
                                            $estadoDatos = false;
                                            break;
                                        } else {
                                            $datosAEnviar .= "&" . $campo . "=" . (int)"1";
                                        }
                                    }
                                } else if ($tipos[$key] == 'time_unix') {
                                    $datosAEnviar .= "&" . $campo . "=" . strtotime($dato[$key]);
                                } else {
                                    if (isset($requeridos[$key]) and $requeridos[$key] == 1 and $dato[$key] == "") {
                                        //si esta vacio y es requerido cancelo
                                        $estadoDatos = false;
                                        break;
                                    } else {
                                        $datosAEnviar .= "&" . $campo . "=" . urlencode($dato[$key]);
                                    }
                                }
                            } else if (isset($requeridos[$key]) and $requeridos[$key] == 1) {
                                //si no tiene datos y es requerido cancelo el leads
                                $estadoDatos = false;
                                break;
                            } else {
                                //sino tiene datos y no es requerido envio null
                                $datosAEnviar .= "&" . $campo . "=null";
                            }
                        }

                        if (!$estadoDatos) {
                            $enviado = new LandingsEnviadosXServicio();
                            $enviado->landing_id = $landing->id;
                            $enviado->servicios_crm_id = $this->servicio->id;
                            $enviado->registro_id = $dato['id'];
                            $enviado->estados_envio_id = 3;
                            $enviado->save();
                        } else {
                            $response = $this->sendDatos($datosAEnviar);
                            if ($response->resultado->estado == 1) {
                                $enviado = new LandingsEnviadosXServicio();
                                $enviado->landing_id = $landing->id;
                                $enviado->servicios_crm_id = $this->servicio->id;
                                $enviado->registro_id = $dato['id'];
                                $enviado->estados_envio_id = 1; //enviado
                                $enviado->save();
                            } elseif ($response->resultado->estado == 3) {
                                $enviado = new LandingsEnviadosXServicio();
                                $enviado->landing_id = $landing->id;
                                $enviado->servicios_crm_id = $this->servicio->id;
                                $enviado->registro_id = $dato['id'];
                                $enviado->estados_envio_id = 2; //rechazado
                                $enviado->save();
                            } else {
                                echo " reboto por problema en CRM " . $dato['id'] . " landing " . $dato['landing_id'] . chr(10) . chr(13);
                            }

                        }

                    }
                }

            }
        }
    }

    private function sendDatos($data)
    {
        try {

            $url = $this->servicio->crm->endpoint . '/' . $this->servicio->datos . $data;
            return json_decode(file_get_contents($url));

        } catch (Exception $e) {
            print "Error" . $e;
            exit;
        }
    }

}
