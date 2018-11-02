<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTipoMediaRequest;
use App\Http\Requests\Admin\UpdateTipoMediaRequest;
use App\Repositories\Admin\TipoMediaRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoMediaController extends InfyOmBaseController
{
    /** @var  TipoMediaRepository */
    private $tipoMediaRepository;

    public function __construct(TipoMediaRepository $tipoMediaRepo)
    {
        $this->tipoMediaRepository = $tipoMediaRepo;
    }

    /**
     * Display a listing of the TipoMedia.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoMediaRepository->pushCriteria(new RequestCriteria($request));
        $tipoMedia = $this->tipoMediaRepository->all();

        return view('admin.tipoMedia.index')
            ->with('tipoMedia', $tipoMedia);
    }

    /**
     * Show the form for creating a new TipoMedia.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tipoMedia.create');
    }

    /**
     * Store a newly created TipoMedia in storage.
     *
     * @param CreateTipoMediaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoMediaRequest $request)
    {
        $input = $request->all();

        $tipoMedia = $this->tipoMediaRepository->create($input);

        Flash::success('TipoMedia saved successfully.');

        return redirect(route('admin.tipoMedia.index'));
    }

    /**
     * Display the specified TipoMedia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoMedia = $this->tipoMediaRepository->findWithoutFail($id);

        if (empty($tipoMedia)) {
            Flash::error('TipoMedia not found');

            return redirect(route('admin.tipoMedia.index'));
        }

        return view('admin.tipoMedia.show')->with('tipoMedia', $tipoMedia);
    }

    /**
     * Show the form for editing the specified TipoMedia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoMedia = $this->tipoMediaRepository->findWithoutFail($id);

        if (empty($tipoMedia)) {
            Flash::error('TipoMedia not found');

            return redirect(route('admin.tipoMedia.index'));
        }

        return view('admin.tipoMedia.edit')->with('tipoMedia', $tipoMedia);
    }

    /**
     * Update the specified TipoMedia in storage.
     *
     * @param  int              $id
     * @param UpdateTipoMediaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoMediaRequest $request)
    {
        $tipoMedia = $this->tipoMediaRepository->findWithoutFail($id);

        if (empty($tipoMedia)) {
            Flash::error('TipoMedia not found');

            return redirect(route('admin.tipoMedia.index'));
        }

        $tipoMedia = $this->tipoMediaRepository->update($request->all(), $id);

        Flash::success('TipoMedia updated successfully.');

        return redirect(route('admin.tipoMedia.index'));
    }

    /**
     * Remove the specified TipoMedia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoMedia = $this->tipoMediaRepository->findWithoutFail($id);

        if (empty($tipoMedia)) {
            Flash::error('TipoMedia not found');

            return redirect(route('admin.tipoMedia.index'));
        }

        $this->tipoMediaRepository->delete($id);

        Flash::success('TipoMedia deleted successfully.');

        return redirect(route('admin.tipoMedia.index'));
    }
}
