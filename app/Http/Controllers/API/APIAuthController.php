<?php

namespace App\Http\Controllers\API;

use App\Models\Admin\Compania;
use App\Models\Admin\DireccionCliente;
use App\Models\Admin\Distribuidor;
use App\Models\Admin\Player;
use App\Models\Admin\Tienda;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\Admin\Cliente;
use App\User;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Repositories\clienteRepository;

class APIAuthController extends Controller
{
    public function userAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'credenciales invalidas']);
            }

        } catch (JWTException $ex) {
            return response()->json(['error' => 'error de autenticacion'], 500);
        }
        return response()->json(compact('token'));
    }


    public function getLoginCliente(Request $request)
    {

        $v = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            $request['login'] = (string)$request->login;
            $request['password'] = (string)$request->password;
            $credentials = $request->only('login', 'password');
            $token = null;
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json($this->error(2, "{'mensaje':'Credenciales invalidas'}"));
                }

            } catch (JWTException $ex) {
                return response()->json($this->error(2, "{'mensaje':'Error de autenticacion'}"));
            }

            $user = User::where("login", $request->input('login'))->first();
            $token = compact('token');

            //guardo el player_id
            $v = Validator::make($request->all(), [
                'player_id' => 'required|unique:players',
            ]);
            if (!$v->fails()) {
                if ($request['player_id'] != '65161703-be4c-45af-abea-f2793f4f4e10') {
                    $player = new Player();
                    $player->player_id = $request['player_id'];
                    $player->user_id = $user->id;
                    $player->save();
                }
            }

//            dd(DB::getQueryLog());
            if ($user->hasRole('vendedor')) {
                if ($user) {
                    if (!$user->vendedor->activo_app) {
                        $user->vendedor->activo_app = true;
                        $user->vendedor->fecha_activo_app = date("Y-m-d");
                        $user->vendedor->save();
                    }

                    $compania = Compania::find($user->vendedor->companiaXDistribuidor->compania_id);
                    $distribuidor = Distribuidor::find($user->distribuidor_id);
                    $clientes = clienteRepository::getTiendasXVendedor($user->vendedor->id);
//                    $dias = clienteRepository::getDiasTiendasXVendedor($user->vendedor->id);
                    $result['user'] = array(
                        'token' => $token['token'],
                        'nombre_contacto' => $user->vendedor->nombre,
                        'cedula' => $user->vendedor->cedula,
                        'compania_id' => $user->vendedor->compania_id,
                        'codigo' => $user->vendedor->codigo,
                        'email' => $user->email,
                        'user_id' => $user->id,
                        'tipo_usuario' => 'vendedor',
                        'compania' => $compania,
                        'distribuidor' => $distribuidor,
                        'tiendas' => $clientes,
//                        'dias' => $dias,
                        'created_at' => $user->vendedor->created_at,
                        'updated_at' => $user->vendedor->updated_at,
                    );
                    return response()->json($this->success(0, $result));
                }
            } elseif ($user->hasRole('cliente')) {
                if (count($user) > 0) {
//                    $tiendas = Tienda::where('cliente_id', '=', $user->cliente->id)->get();
                    if (!$user->cliente->activo) {
                        $user->cliente->activo = true;
                        $user->cliente->fecha_activo = date("Y-m-d");
                        $user->cliente->save();
                    }

                    $passwordCuentaCorriente = (isset($user->password_cuenta_corriente)) ? true : false;
                    $tiendas = DB::table('tiendas as t')->leftJoin('ciudades as c', 'c.id', '=', 't.ciudad_id')
                        ->where('cliente_id', '=', $user->cliente->id)->select('t.*', 'c.nombre as ciudad')->get();
                    $result['user'] = array(
                        'token' => $token['token'],
                        'nombre_contacto' => $user->cliente->nombre_contacto,
                        'telefono_contacto' => $user->cliente->telefono_contacto,
                        'membresia' => $user->cliente->membresia,
                        'cedula' => $user->cliente->cedula,
                        'email' => $user->email,
                        'user_id' => $user->id,
                        'user_act' => $passwordCuentaCorriente,
                        'corriente_id' => (isset($user->cuentaCorriente->id)) ? $user->cuentaCorriente->id : null,
                        'tipo_usuario' => 'cliente',
                        'tiendas' => $tiendas,
                    );
                    return response()->json($this->success(0, $result));
                }
            }
        }
    }

}
