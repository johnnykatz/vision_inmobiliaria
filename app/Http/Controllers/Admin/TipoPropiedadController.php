<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTipoPropiedadRequest;
use App\Http\Requests\Admin\UpdateTipoPropiedadRequest;
use App\Repositories\Admin\TipoPropiedadRepository;
use App\Http\Controllers\Admin\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoPropiedadController extends InfyOmBaseController
{
    /** @var  TipoPropiedadRepository */
    private $tipoPropiedadRepository;

    public function __construct(TipoPropiedadRepository $tipoPropiedadRepo)
    {
        $this->tipoPropiedadRepository = $tipoPropiedadRepo;
    }

    /**
     * Display a listing of the TipoPropiedad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoPropiedadRepository->pushCriteria(new RequestCriteria($request));
        $tipoPropiedads = $this->tipoPropiedadRepository->all();

        return view('admin.tipoPropiedads.index')
            ->with('tipoPropiedads', $tipoPropiedads);
    }

    /**
     * Show the form for creating a new TipoPropiedad.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tipoPropiedads.create');
    }

    /**
     * Store a newly created TipoPropiedad in storage.
     *
     * @param CreateTipoPropiedadRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPropiedadRequest $request)
    {
        $input = $request->all();

        $tipoPropiedad = $this->tipoPropiedadRepository->create($input);

        Flash::success('TipoPropiedad saved successfully.');

        return redirect(route('admin.tipoPropiedads.index'));
    }

    /**
     * Display the specified TipoPropiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoPropiedad = $this->tipoPropiedadRepository->findWithoutFail($id);

        if (empty($tipoPropiedad)) {
            Flash::error('TipoPropiedad not found');

            return redirect(route('admin.tipoPropiedads.index'));
        }

        return view('admin.tipoPropiedads.show')->with('tipoPropiedad', $tipoPropiedad);
    }

    /**
     * Show the form for editing the specified TipoPropiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoPropiedad = $this->tipoPropiedadRepository->findWithoutFail($id);

        if (empty($tipoPropiedad)) {
            Flash::error('TipoPropiedad not found');

            return redirect(route('admin.tipoPropiedads.index'));
        }

        return view('admin.tipoPropiedads.edit')->with('tipoPropiedad', $tipoPropiedad);
    }

    /**
     * Update the specified TipoPropiedad in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPropiedadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPropiedadRequest $request)
    {
        $tipoPropiedad = $this->tipoPropiedadRepository->findWithoutFail($id);

        if (empty($tipoPropiedad)) {
            Flash::error('TipoPropiedad not found');

            return redirect(route('admin.tipoPropiedads.index'));
        }

        $tipoPropiedad = $this->tipoPropiedadRepository->update($request->all(), $id);

        Flash::success('TipoPropiedad updated successfully.');

        return redirect(route('admin.tipoPropiedads.index'));
    }

    /**
     * Remove the specified TipoPropiedad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoPropiedad = $this->tipoPropiedadRepository->findWithoutFail($id);

        if (empty($tipoPropiedad)) {
            Flash::error('TipoPropiedad not found');

            return redirect(route('admin.tipoPropiedads.index'));
        }

        $this->tipoPropiedadRepository->delete($id);

        Flash::success('TipoPropiedad deleted successfully.');

        return redirect(route('admin.tipoPropiedads.index'));
    }
}
