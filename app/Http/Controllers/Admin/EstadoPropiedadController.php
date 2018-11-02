<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateEstadoPropiedadRequest;
use App\Http\Requests\Admin\UpdateEstadoPropiedadRequest;
use App\Repositories\Admin\EstadoPropiedadRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EstadoPropiedadController extends InfyOmBaseController
{
    /** @var  EstadoPropiedadRepository */
    private $estadoPropiedadRepository;

    public function __construct(EstadoPropiedadRepository $estadoPropiedadRepo)
    {
        $this->estadoPropiedadRepository = $estadoPropiedadRepo;
    }

    /**
     * Display a listing of the EstadoPropiedad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estadoPropiedadRepository->pushCriteria(new RequestCriteria($request));
        $estadoPropiedads = $this->estadoPropiedadRepository->all();

        return view('admin.estadoPropiedads.index')
            ->with('estadoPropiedads', $estadoPropiedads);
    }

    /**
     * Show the form for creating a new EstadoPropiedad.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.estadoPropiedads.create');
    }

    /**
     * Store a newly created EstadoPropiedad in storage.
     *
     * @param CreateEstadoPropiedadRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoPropiedadRequest $request)
    {
        $input = $request->all();

        $estadoPropiedad = $this->estadoPropiedadRepository->create($input);

        Flash::success('EstadoPropiedad saved successfully.');

        return redirect(route('admin.estadoPropiedads.index'));
    }

    /**
     * Display the specified EstadoPropiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoPropiedad = $this->estadoPropiedadRepository->findWithoutFail($id);

        if (empty($estadoPropiedad)) {
            Flash::error('EstadoPropiedad not found');

            return redirect(route('admin.estadoPropiedads.index'));
        }

        return view('admin.estadoPropiedads.show')->with('estadoPropiedad', $estadoPropiedad);
    }

    /**
     * Show the form for editing the specified EstadoPropiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoPropiedad = $this->estadoPropiedadRepository->findWithoutFail($id);

        if (empty($estadoPropiedad)) {
            Flash::error('EstadoPropiedad not found');

            return redirect(route('admin.estadoPropiedads.index'));
        }

        return view('admin.estadoPropiedads.edit')->with('estadoPropiedad', $estadoPropiedad);
    }

    /**
     * Update the specified EstadoPropiedad in storage.
     *
     * @param  int              $id
     * @param UpdateEstadoPropiedadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoPropiedadRequest $request)
    {
        $estadoPropiedad = $this->estadoPropiedadRepository->findWithoutFail($id);

        if (empty($estadoPropiedad)) {
            Flash::error('EstadoPropiedad not found');

            return redirect(route('admin.estadoPropiedads.index'));
        }

        $estadoPropiedad = $this->estadoPropiedadRepository->update($request->all(), $id);

        Flash::success('EstadoPropiedad updated successfully.');

        return redirect(route('admin.estadoPropiedads.index'));
    }

    /**
     * Remove the specified EstadoPropiedad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoPropiedad = $this->estadoPropiedadRepository->findWithoutFail($id);

        if (empty($estadoPropiedad)) {
            Flash::error('EstadoPropiedad not found');

            return redirect(route('admin.estadoPropiedads.index'));
        }

        $this->estadoPropiedadRepository->delete($id);

        Flash::success('EstadoPropiedad deleted successfully.');

        return redirect(route('admin.estadoPropiedads.index'));
    }
}
