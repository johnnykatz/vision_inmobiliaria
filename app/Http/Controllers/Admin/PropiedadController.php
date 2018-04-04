<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePropiedadRequest;
use App\Http\Requests\Admin\UpdatePropiedadRequest;
use App\Models\Admin\EstadoPropiedad;
use App\Models\Admin\Media;
use App\Models\Admin\TipoOperacion;
use App\Models\Admin\TipoPropiedad;
use App\Repositories\Admin\PropiedadRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

ini_set('upload_max_filesize', '5M');
ini_set("memory_limit", "1000M");
set_time_limit(0);
class PropiedadController extends InfyOmBaseController
{
    /** @var  PropiedadRepository */
    private $propiedadRepository;

    public function __construct(PropiedadRepository $propiedadRepo)
    {
        $this->propiedadRepository = $propiedadRepo;
    }

    /**
     * Display a listing of the Propiedad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $propiedades = $this->propiedadRepository->getPropiedadesFilter($request);
        return view('admin.propiedads.index')
            ->with('propiedades', $propiedades);
    }

    /**
     * Show the form for creating a new Propiedad.
     *
     * @return Response
     */
    public function create()
    {
        $estados = EstadoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tipos_propiedades = TipoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tipos_operaciones = TipoOperacion::orderBy('nombre', 'ASC')->lists('nombre', 'id');

        return view('admin.propiedads.create')
            ->with('estados', $estados)
            ->with('tipos_propiedades', $tipos_propiedades)
            ->with('tipos_operaciones', $tipos_operaciones);
    }

    /**
     * Store a newly created Propiedad in storage.
     *
     * @param CreatePropiedadRequest $request
     *
     * @return Response
     */
    public function store(CreatePropiedadRequest $request)
    {
        ini_set('upload_max_filesize', '5M');
        ini_set("memory_limit", "1000M");
        set_time_limit(0);
        $input = $request->all();
//dd($request);
        $propiedad = $this->propiedadRepository->create($input);

        foreach ($request->file('imagen') as $key => $imagen) {
            if (isset($imagen)) {
                $nombreImagen = $this->reSizeImagen($imagen);
                $imagenObj = new Media();
                $imagenObj->tipo_media_id = 1;
                $imagenObj->propiedad_id = $propiedad->id;
                if ($request['principal'][$key] == 'si') {
                    $imagenObj->descripcion = 'principal';
                    $imagenObj->slide = true;
                }
                $imagenObj->url = $nombreImagen;
                $imagenObj->save();
            }
        }

        Flash::success('Propiedad guardada con exito.');

        return redirect(route('admin.propiedads.index'));
    }

    /**
     * Display the specified Propiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propiedad = $this->propiedadRepository->findWithoutFail($id);

        if (empty($propiedad)) {
            Flash::error('Propiedad not found');

            return redirect(route('admin.propiedads.index'));
        }


        return view('admin.propiedads.show')->with('propiedad', $propiedad);
    }

    /**
     * Show the form for editing the specified Propiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propiedad = $this->propiedadRepository->findWithoutFail($id);

        if (empty($propiedad)) {
            Flash::error('Propiedad not found');

            return redirect(route('admin.propiedads.index'));
        }
        $estados = EstadoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tipos_propiedades = TipoPropiedad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $tipos_operaciones = TipoOperacion::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $medias = Media::where('propiedad_id', $propiedad->id)->get();
        return view('admin.propiedads.edit')
            ->with('medias', $medias)
            ->with('estados', $estados)
            ->with('tipos_propiedades', $tipos_propiedades)
            ->with('tipos_operaciones', $tipos_operaciones)
            ->with('propiedad', $propiedad);
    }

    /**
     * Update the specified Propiedad in storage.
     *
     * @param  int $id
     * @param UpdatePropiedadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePropiedadRequest $request)
    {
        $propiedad = $this->propiedadRepository->findWithoutFail($id);

        if (empty($propiedad)) {
            Flash::error('Propiedad not found');

            return redirect(route('admin.propiedads.index'));
        }

        $propiedad = $this->propiedadRepository->update($request->all(), $id);
        $medias = Media::where('propiedad_id', $propiedad->id)->get();
        foreach ($medias as $media) {
            if (!in_array($media->id, $request['imagen_old'])) {
                if (is_file(public_path() . '/imagenes/propiedades/' . $media->url)) {
                    unlink(public_path() . '/imagenes/propiedades/' . $media->url);
                }
                $media->delete();
            }
        }


        foreach ($request->file('imagen') as $key => $imagen) {
            if (isset($imagen)) {
                $nombreImagen = $this->reSizeImagen($imagen);
                if ($request['imagen_old'][$key] != "") {
                    $imagenObj = Media::find($request['imagen_old'][$key]);
                    if (is_file(public_path() . '/imagenes/propiedades/' . $media->url)) {
                        unlink(public_path() . '/imagenes/propiedades/' . $media->url);
                    }
                } else {
                    $imagenObj = new Media();
                }
                $imagenObj->tipo_media_id = 1;
                $imagenObj->propiedad_id = $propiedad->id;
                if ($request['principal'][$key] == 'si') {
                    $imagenObj->slide = true;
                    $imagenObj->descripcion = 'principal';
                }
                $imagenObj->url = $nombreImagen;
                $imagenObj->save();
            }
        }

        Flash::success('Propiedad actualizada con exito.');

        return redirect(route('admin.propiedads.index'));
    }

    /**
     * Remove the specified Propiedad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propiedad = $this->propiedadRepository->findWithoutFail($id);

        if (empty($propiedad)) {
            Flash::error('Propiedad not found');

            return redirect(route('admin.propiedads.index'));
        }
        $medias = Media::where('propiedad_id', $propiedad->id)->get();
        foreach ($medias as $media) {
            if (is_file(public_path() . '/imagenes/propiedades/' . $media->url)) {
                unlink(public_path() . '/imagenes/propiedades/' . $media->url);
            }
            $media->delete();
        }
        $this->propiedadRepository->delete($id);

        Flash::success('Propiedad eliminada con exito.');

        return redirect(route('admin.propiedads.index'));
    }

    private function reSizeImagen($file)
    {
        $nombreImagen = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20) . '.' . $file->getClientOriginalExtension();
        //Creamos una instancia de la libreria instalada
        $image = \Image::make($file);
        //Ruta donde queremos guardar las imagenes
        $path = public_path() . '/imagenes/propiedades/';

        // Guardar Original
//        $image->save($path . $nombreImagen);
        // Cambiar de tamaño
//        $image->widen(500);
        // Guardar
        $image->save($path . $nombreImagen);
        return $nombreImagen;
    }

}
