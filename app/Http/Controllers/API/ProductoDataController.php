<?php

namespace App\Http\Controllers\API;

use App\Models\Admin\Cliente;
use App\Models\Admin\Compania;
use App\Models\Admin\CompaniaXDistribuidor;
use App\Models\Admin\EstadoPedido;
use App\Models\Admin\LogPedido;
use App\Models\Admin\ProductoDistribuidor;
use App\Models\Admin\Tienda;
use App\Models\Admin\TiendaXDistribuidor;
use App\Providers\ApiProductosProvider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin\Categoria;
use App\Models\Admin\Oferta;
use App\Models\Admin\Producto;
use App\Models\Admin\PedidoXProducto;
use App\Models\Admin\Pedido;
use App\User;
use DB;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Zizaco\Entrust\HasRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Providers\ApiFunctionProvider as functions;
use App\Services\OneSignal;

class ProductoDataController extends Controller
{
    private $productosProvider;

    public function __construct(ApiProductosProvider $productosProv)
    {
        $this->productosProvider = $productosProv;
    }

    function getCategorias(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tienda_id' => 'required|integer',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        }
        $result = $this->productosProvider->getCategoriasDisponibles($request, $user);
        return $this->getResponse($result);
    }

    function getOfertas(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tienda_id' => 'required|integer',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        }
        $result = $this->productosProvider->getResultXServicio("get-ofertas", $request, $user);
        return $this->getResponse($result);
    }

    /*
     * tipo 1 => productos por companias
     * tipo 2 => productos por marcas
     */
    function getProdXDependencia(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tipo_id' => 'integer|required|min:1|max:2',
            'dependencia_id' => 'integer|required',
            'tienda_id' => 'integer|required',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            $result = $this->productosProvider->getResultXServicio("get-prod-x-dependencia", $request, $user);
            return $this->getResponse($result);
        }
    }


    function getProdXCategoria(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tienda_id' => 'required|integer',
            'categoria_id' => 'required'
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        }

        $result = $this->productosProvider->getResultXServicio("get-prod-x-categoria", $request, $user);
        return $this->getResponse($result);

    }


    function getBusqueda(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tienda_id' => 'integer|required',
            'buscar' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            $result = $this->productosProvider->getResultXServicio("get-busqueda", $request, $user);
            return $this->getResponse($result);
        }

    }

    function setPedido(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(), [
            'tienda_id' => 'required',
            'productos' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            if (!$user) {
                return response()->json($this->error(2, array("El usuario no existe")));
            } else {
                if ($user->hasRole('vendedor')) {
                    return $this->setPedidoVendedor($request, $user);
                } else {
                    if (!isset($user->cliente)) {
                        return response()->json($this->error(2, array("El cliente no existe")));
                    } else {
                        $result = $this->productosProvider->getResultSetPedidoCliente($request, $user);
                        return $this->getResponse($result);
                    }
                }

            }
        }
    }

    function getPedido(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole("cliente")) {
            $v = Validator::make($request->all(), [
                'tienda_id' => 'integer|required',
            ]);
            if (!isset($user->cliente)) {
                return response()->json($this->error(2, array("El cliente no existe")));
            }
        } else {
            $v = Validator::make($request->all(), [
                'tienda_id' => 'integer',
            ]);
        }
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            $result = $this->productosProvider->getResultPedido($request, $user);
            return $this->getResponse($result);
        }
    }

    function setPedidoVendedor(Request $request, $user)
    {
        $tienda = Tienda::find($request->input('tienda_id'));
        if (!isset($user->vendedor)) {
            return response()->json($this->error(2, array("El vendedor no existe")));
        } else if (!isset($tienda)) {
            return response()->json($this->error(2, array("La tienda no existe")));
        } else {
//            $valor = 0;
//            foreach ($request['productos'] as $producto) {
//                $valor = $valor + (floatval($producto['valor'] * floatval($producto['cantidad'])));
//            }
//            $valor_minimo = functions::getPedidoMinimo($user->vendedor->companiaXDistribuidor->distribuidor_id);
//
//            if ($valor < $valor_minimo->valor_minimo_compra) {
//                return response()->json($this->error(2, array("El distribuidor " . $valor_minimo->nombre . " no acepta pedidos menores a $" . $valor_minimo->valor_minimo_compra)));
//            }

            DB::beginTransaction();
            $pedido = Pedido::where('tienda_id', $request->input('tienda_id'))
                ->where('distribuidor_id', $user->vendedor->companiaXDistribuidor->distribuidor_id)
                ->where('compania_id', $user->vendedor->companiaXDistribuidor->compania_id)
                ->whereIn('estado_pedido_id', [1, 2, 5])
                ->first();

            if (!$pedido) {
                $pedido = new Pedido();
                $pedido->cod_pedido = "P" . date("Ymdhis") . rand(0, 10);
                $pedido->tienda_id = $request->input('tienda_id');
                $pedido->estado_pedido_id = 5; //estado propuesto
                $pedido->compania_id = $user->vendedor->companiaXDistribuidor->compania_id;
                $pedido->distribuidor_id = $user->vendedor->companiaXDistribuidor->distribuidor_id;
            } else {
                //si existe el pedido elimino todos suis productos
                $pedidosFault = DB::table('pedidos_x_productos')->where('pedido_id', $pedido->id)->delete();
                $pedido->estado_pedido_id = $pedido->estado_pedido_id;
            }

            $pedido->vendedor_id = $user->vendedor->id;
            $pedido->save();

            //guardo log de pedido
            $log_pedido = new LogPedido();
            $log_pedido->pedido_id = $pedido->id;
            $log_pedido->user_id = $user->id;
            $log_pedido->tipo_usuario = "vendedor";
            $log_pedido->estado_pedido_id = $pedido->estado_pedido_id;
            $log_pedido->save();

            $valor_total = 0;
            foreach ($request['productos'] as $producto) {

                $v = Validator::make($producto, [
                    'producto_distribuidor_id' => 'required',
                    'valor' => 'required',
                    'valor_original' => 'required',
                    'cantidad' => 'required'
                ]);
                if (!$v->fails()) {
                    $existeProducto = ProductoDistribuidor::where("id", $producto['producto_distribuidor_id'])->first();

                    if ($existeProducto) {
                        $pedido_producto = new PedidoXProducto();
                        $pedido_producto->pedido_id = $pedido->id;
                        $pedido_producto->producto_distribuidor_id = $producto['producto_distribuidor_id'];
                        $pedido_producto->valor = $producto['valor'];
                        $pedido_producto->cantidad = $producto['cantidad'];
                        $pedido_producto->valor_original = $producto["valor_original"];
                        if ($producto["valor_original"] > $producto["valor"]) {
                            $pedido_producto->oferta = true;
                        } else {
                            $pedido_producto->oferta = false;
                        }
                        $pedido_producto->estado_id = 2;

                        $pedido_producto->save();
                        $valor_total += floatval($producto['valor']) * floatval($producto['cantidad']);
                    } else {
                        DB::rollBack();
                        return response()->json($this->error(2, array("El producto con id " . $producto['producto_distribuidor_id'] . " no existe o no pertenece a su compañia")));
                    }
                } else {
                    DB::rollBack();
                    return response()->json($this->error(2, $v->errors()->all()));
                }
            }
            $pedido->valor_pedido = $valor_total;
            $pedido->save();
            DB::commit();
            //envio notificacion al cliente
//            if ($user->players and $user->players->count() > 0) {
//                foreach ($user->players as $player) {
//                    $players[] = $player->player_id;
//                }
//                $oneSignal = new OneSignal();
////                $player_id='65161703-be4c-45af-abea-f2793f4f4e10';
//                $response = $oneSignal->enviarNotificacionUnit($players, "Tiene un pedido propuesto pendiente de confirmación", ['pedido_id' => $pedido->id]);
//            }
            return response()->json($this->success(0, array("pedido_id" => $pedido->id)));
        }
    }


    public function setEstadoPedido(Request $request)
    {
        $v = Validator::make($request->all(), [
            'pedido_id' => 'required|integer',
            'estado' => 'required|string'
        ]);
        if ($v->fails()) {
            return response()->json($this->error(2, $v->errors()->all()));
        } else {
            $user = Auth::user();
            if ($user) {
                $estado = EstadoPedido::where('slug', $request->input('estado'))->first();
                if ($estado) {
                    if ($user->hasRole('vendedor')) {
                        if (!isset($user->vendedor)) {
                            return response()->json($this->error(2, array("El vendedor no existe")));
                        } else {
                            $pedido = Pedido::find($request->input('pedido_id'));
                            $pedido->estado_pedido_id = $estado->id;
                            $pedido->vendedor_id = $user->vendedor->id;
                            $pedido->save();

                            $logPedido = new LogPedido();
                            $logPedido->pedido_id = $request->input('pedido_id');
                            $logPedido->user_id = $user->id;
                            $logPedido->tipo_usuario = "vendedor";
                            $logPedido->estado_pedido_id = $estado->id;
                            $logPedido->save();

                            return response()->json($this->success(0, array("pedido_id" => $pedido->id)));
                        }
                    } elseif ($user->hasRole('cliente')) {
                        $pedido = Pedido::find($request->input('pedido_id'));
                        //controlo que el pedido exista
                        if ($pedido) {
                            //controlo que el pedido sea del cliente
                            if ($user->cliente->tiendas->contains('id', $pedido->tienda_id)) {
                                $pedido->estado_pedido_id = $estado->id;
                                $pedido->save();
                                $logPedido = new LogPedido();
                                $logPedido->pedido_id = $request->input('pedido_id');
                                $logPedido->user_id = $user->id;
                                $logPedido->tipo_usuario = "cliente";
                                $logPedido->estado_pedido_id = $estado->id;
                                $logPedido->save();
                                return response()->json($this->success(0, array("pedido_id" => $pedido->id)));
                            } else {
                                return response()->json($this->error(2, array("El pedido que intenta actualizar corresponde a otra tienda")));
                            }
                        } else {
                            return response()->json($this->error(2, array("El pedido que intenta actualizar no existe")));
                        }
                    } else {
                        return response()->json($this->error(2, array("El usuario no tiene perfil para confirmar un pedido")));
                    }
                } else {
                    return response()->json($this->error(2, array("El estado no existe")));
                }
            } else {
                return response()->json($this->error(2, array("El usuario no existe")));
            }
        }
    }

    /*
     * devuelve el monto y tienda_id de cada pedido realizado por un vendedor en el dia
     */

    function getResumenPedidosDiariosVendedor()
    {
        $user = Auth::user();
        if ($user->hasRole("vendedor")) {
            if (!isset($user->vendedor)) {
                return response()->json($this->error(2, array("mensaje" => "El vendedor no existe")));
            } else {
                $pedidos = $this->productosProvider->getResumenPedidosDiariosVendedor($user->vendedor->id);
                return response()->json($this->success((count($pedidos) > 0) ? 0 : 1, array("pedidos" => $pedidos)));
            }
        } else {
            return response()->json($this->error(2, array("mensaje" => "El usuario no tiene perfil de Vendedor")));
        }
    }

    private function getResponse($result)
    {
        if ($result['type'] == "success") {
            return response()->json($this->success($result['code'], $result['data']));
        } else {
            return response()->json($this->error($result['code'], $result['data']));
        }
    }
}
