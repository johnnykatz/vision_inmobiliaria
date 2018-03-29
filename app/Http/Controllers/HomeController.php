<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Admin\Media;
use App\Models\Admin\Propiedad;
use App\Models\Admin\TipoOperacion;
use App\Models\Admin\TipoPropiedad;
use App\Models\Soap;
use Illuminate\Http\Request;
use App\Services\OneSignal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propiedadesSlide = Propiedad::from('propiedades as p')
            ->join("estados_propiedades as e", "e.id", '=', 'p.estado_propiedad_id')
            ->where('e.slug', "disponible")
            ->where('p.slide', true)
            ->select("p.*")->distinct()->get();
        $ultimas = Propiedad::from('propiedades as p')
            ->join("estados_propiedades as e", "e.id", '=', 'p.estado_propiedad_id')
            ->where('e.slug', "disponible")
            ->where('p.slide', true)
            ->orderBy("updated_at", "desc")
            ->orderBy("p.orden", "desc")
            ->select("p.*")->distinct()->limit(15)->get();
        foreach ($ultimas as $ultima) {
            $imagen = Media::where('propiedad_id', $ultima->id)->where('slide', true)->first();
            $ultima->imagen = $imagen;
        }

        foreach ($propiedadesSlide as $key => $propiedad) {
            $imagen = Media::where('propiedad_id', $propiedad->id)->where('slide', true)->first();
//            if ($imagen) {
            $propiedad->imagen = $imagen;
//            } else {
//                unset($propiedadesSlide[$key]);
//            }
        }
        $precios = array(
            "1000-3000" => "$1,000 - $3,000",
            "3000-5000" => "$3,000 - $5,000",
            "5000-7000" => "$5,000 - $7,000",
            "7000-9000" => "$7,000 - $9,000",
            "9000-1000000000" => "$9,000 - +"
        );
        $tiposPropiedades = TipoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tiposOperaciones = TipoOperacion::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $destacadas = $this->getDestacadas();
        foreach ($destacadas as $destacada) {
            $imagen = Media::where('propiedad_id', $destacada->id)->where('slide', true)->first();
            $destacada->imagen = $imagen;
        }

//        dd($destacadas);
        return view('pagina.index')
            ->with('tiposPropiedades', $tiposPropiedades)
            ->with('ultimas', $ultimas)
            ->with('tiposOperaciones', $tiposOperaciones)
            ->with('propiedadesSlide', $propiedadesSlide)
            ->with('precios', collect($precios))
            ->with('destacadas', $destacadas);
    }


    function property_detail($id)
    {
        $propiedad = Propiedad::find($id);
        $destacadas = $this->getDestacadas();
        foreach ($destacadas as $destacada) {
            $imagen = Media::where('propiedad_id', $destacada->id)->where('slide', true)->first();
            $destacada->imagen = $imagen;
        }
//dd($destacadas);
        return view('pagina.property-detail')
            ->with('propiedad', $propiedad)
            ->with('destacadas', $destacadas);
    }


    public function listado(Request $request)
    {

        $tiposPropiedades = TipoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tiposOperaciones = TipoOperacion::orderBy('nombre', 'ASC')->lists('nombre', 'id');

        $destacadas = $this->getDestacadas();
        foreach ($destacadas as $destacada) {
            $imagen = Media::where('propiedad_id', $destacada->id)->where('slide', true)->first();
            $destacada->imagen = $imagen;
        }
        $propiedades = $this->getPropiedadesFilter($request);
        foreach ($propiedades as $propiedad) {
            $imagen = Media::where('propiedad_id', $propiedad->id)->where('descripcion', 'principal')->first();
            $propiedad->imagen = $imagen;
        }
        $precios = array(
            "1000-3000" => "$1,000 - $3,000",
            "3000-5000" => "$3,000 - $5,000",
            "5000-7000" => "$5,000 - $7,000",
            "7000-9000" => "$7,000 - $9,000",
            "9000-1000000000" => "$9,000 - +"
        );
        return view('pagina.list')
            ->with('propiedades', $propiedades)
            ->with('tiposPropiedades', $tiposPropiedades)
            ->with('tiposOperaciones', $tiposOperaciones)
            ->with('precios', collect($precios))
            ->with('destacadas', $destacadas);
    }


    public function contact()
    {
        return view('pagina.contact');
    }

    public function agents()
    {
        return view('pagina.agents');
    }

    public function about()
    {
        return view('pagina.about');
    }

    public function tasaciones()
    {
        return view('pagina.tasaciones');
    }

    public function administramos()
    {
        return view('pagina.administramos');
    }

    public function homeAdmin()
    {
        return view('home');
    }

    private function getPropiedadesFilter($request)
    {
//        dd($request->all());
        $propiedades = Propiedad::from("propiedades as p")
            ->join("estados_propiedades as e", "e.id", '=', 'p.estado_propiedad_id')
            ->join("tipos_propiedades as tp", "tp.id", '=', 'p.tipo_propiedad_id')
            ->join('tipos_operaciones as to', 'to.id', '=', 'p.tipo_operacion_id')
            ->where('e.slug', 'disponible');
        if ($request['tipo_propiedad_id'] != "") {
            $propiedades->where('p.tipo_propiedad_id', $request['tipo_propiedad_id']);
        }
        if ($request['tipo_operacion_id'] != "") {
            $propiedades->where('p.tipo_operacion_id', $request['tipo_operacion_id']);
        }
        if ($request['precio'] != "") {
            $precios = explode("-", $request['precio']);
            $propiedades->whereBetween('p.precio', $precios);
        }
        if ($request['comodin'] != '') {
            $propiedades->where(function ($query) use ($request) {
                $query->orWhere('p.nombre', 'LIKE', "%" . $request['comodin'] . "%")
                    ->orWhere('p.direccion', 'LIKE', "%" . $_REQUEST['comodin'] . "%")
                    ->orWhere('p.descripcion', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
            }
            );
        }
        return $propiedades->select("p.*")->orderBy("p.precio", "asc")->paginate(30);

    }

    private function getDestacadas()
    {
        return Propiedad::from("propiedades as p")->join("estados_propiedades as e", "e.id", '=', 'p.estado_propiedad_id')
            ->where('e.slug', "disponible")
            ->where('destacada', true)
            ->select('p.*')
            ->orderBy("p.created_at", "DESC")->limit(6)->get();
    }


}
