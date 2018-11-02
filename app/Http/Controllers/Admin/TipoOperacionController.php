<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTipoOperacionRequest;
use App\Http\Requests\Admin\UpdateTipoOperacionRequest;
use App\Repositories\Admin\TipoOperacionRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoOperacionController extends InfyOmBaseController
{
    /** @var  TipoOperacionRepository */
    private $tipoOperacionRepository;

    public function __construct(TipoOperacionRepository $tipoOperacionRepo)
    {
        $this->tipoOperacionRepository = $tipoOperacionRepo;
    }

    /**
     * Display a listing of the TipoOperacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoOperacionRepository->pushCriteria(new RequestCriteria($request));
        $tipoOperacions = $this->tipoOperacionRepository->all();

        return view('admin.tipoOperacions.index')
            ->with('tipoOperacions', $tipoOperacions);
    }

    /**
     * Show the form for creating a new TipoOperacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tipoOperacions.create');
    }

    /**
     * Store a newly created TipoOperacion in storage.
     *
     * @param CreateTipoOperacionRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoOperacionRequest $request)
    {
        $input = $request->all();

        $tipoOperacion = $this->tipoOperacionRepository->create($input);

        Flash::success('TipoOperacion saved successfully.');

        return redirect(route('admin.tipoOperacions.index'));
    }

    /**
     * Display the specified TipoOperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoOperacion = $this->tipoOperacionRepository->findWithoutFail($id);

        if (empty($tipoOperacion)) {
            Flash::error('TipoOperacion not found');

            return redirect(route('admin.tipoOperacions.index'));
        }

        return view('admin.tipoOperacions.show')->with('tipoOperacion', $tipoOperacion);
    }

    /**
     * Show the form for editing the specified TipoOperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoOperacion = $this->tipoOperacionRepository->findWithoutFail($id);

        if (empty($tipoOperacion)) {
            Flash::error('TipoOperacion not found');

            return redirect(route('admin.tipoOperacions.index'));
        }

        return view('admin.tipoOperacions.edit')->with('tipoOperacion', $tipoOperacion);
    }

    /**
     * Update the specified TipoOperacion in storage.
     *
     * @param  int              $id
     * @param UpdateTipoOperacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoOperacionRequest $request)
    {
        $tipoOperacion = $this->tipoOperacionRepository->findWithoutFail($id);

        if (empty($tipoOperacion)) {
            Flash::error('TipoOperacion not found');

            return redirect(route('admin.tipoOperacions.index'));
        }

        $tipoOperacion = $this->tipoOperacionRepository->update($request->all(), $id);

        Flash::success('TipoOperacion updated successfully.');

        return redirect(route('admin.tipoOperacions.index'));
    }

    /**
     * Remove the specified TipoOperacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoOperacion = $this->tipoOperacionRepository->findWithoutFail($id);

        if (empty($tipoOperacion)) {
            Flash::error('TipoOperacion not found');

            return redirect(route('admin.tipoOperacions.index'));
        }

        $this->tipoOperacionRepository->delete($id);

        Flash::success('TipoOperacion deleted successfully.');

        return redirect(route('admin.tipoOperacions.index'));
    }
}
