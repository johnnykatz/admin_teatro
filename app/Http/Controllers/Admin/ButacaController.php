<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateButacaRequest;
use App\Http\Requests\Admin\UpdateButacaRequest;
use App\Repositories\Admin\ButacaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ButacaController extends AppBaseController
{
    /** @var  ButacaRepository */
    private $butacaRepository;

    public function __construct(ButacaRepository $butacaRepo)
    {
        $this->butacaRepository = $butacaRepo;
    }

    /**
     * Display a listing of the Butaca.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->butacaRepository->pushCriteria(new RequestCriteria($request));
        $butacas = $this->butacaRepository->all();

        return view('admin.butacas.index')
            ->with('butacas', $butacas);
    }

    /**
     * Show the form for creating a new Butaca.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.butacas.create');
    }

    /**
     * Store a newly created Butaca in storage.
     *
     * @param CreateButacaRequest $request
     *
     * @return Response
     */
    public function store(CreateButacaRequest $request)
    {
        $input = $request->all();

        $butaca = $this->butacaRepository->create($input);

        Flash::success('Butaca registrada.');

        return redirect(route('admin.butacas.index'));
    }

    /**
     * Display the specified Butaca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $butaca = $this->butacaRepository->findWithoutFail($id);

        if (empty($butaca)) {
            Flash::error('Butaca not found');

            return redirect(route('admin.butacas.index'));
        }

        return view('admin.butacas.show')->with('butaca', $butaca);
    }

    /**
     * Show the form for editing the specified Butaca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $butaca = $this->butacaRepository->findWithoutFail($id);

        if (empty($butaca)) {
            Flash::error('Butaca not found');

            return redirect(route('admin.butacas.index'));
        }

        return view('admin.butacas.edit')->with('butaca', $butaca);
    }

    /**
     * Update the specified Butaca in storage.
     *
     * @param  int $id
     * @param UpdateButacaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateButacaRequest $request)
    {
        $butaca = $this->butacaRepository->findWithoutFail($id);

        if (empty($butaca)) {
            Flash::error('Butaca not found');

            return redirect(route('admin.butacas.index'));
        }

        $butaca = $this->butacaRepository->update($request->all(), $id);

        Flash::success('Butaca registrada.');

        return redirect(route('admin.butacas.index'));
    }

    /**
     * Remove the specified Butaca from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $butaca = $this->butacaRepository->findWithoutFail($id);

        if (empty($butaca)) {
            Flash::error('Butaca not found');

            return redirect(route('admin.butacas.index'));
        }
        if ($this->butacaRepository->controlButaca($butaca->id)) {
            $this->butacaRepository->delete($id);
            Flash::success('Butaca eliminada.');
        } else {
            Flash::error('La Butaca no puede ser eliminada.');
        }

        return redirect(route('admin.butacas.index'));
    }

    public function getButacasLibresAjax(Request $request)
    {
        if ($request->ajax()) {
            $butacas = $this->butacaRepository->getButacasLibres($request['fecha'], $request['reserva_id']);
            return response()->json($butacas);
        }
    }
}
