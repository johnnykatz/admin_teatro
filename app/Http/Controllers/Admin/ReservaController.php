<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateReservaRequest;
use App\Http\Requests\Admin\UpdateReservaRequest;
use App\Repositories\Admin\ReservaRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReservaController extends AppBaseController
{
    /** @var  ReservaRepository */
    private $reservaRepository;

    public function __construct(ReservaRepository $reservaRepo)
    {
        $this->reservaRepository = $reservaRepo;
    }

    /**
     * Display a listing of the Reserva.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $reservas = $this->reservaRepository->getReservasFilter($request);

        return view('admin.reservas.index')
            ->with('reservas', $reservas);
    }

    /**
     * Show the form for creating a new Reserva.
     *
     * @return Response
     */
    public function create()
    {
        $butacas = array();
        return view('admin.reservas.create')->with('butacas', $butacas);
    }

    /**
     * Store a newly created Reserva in storage.
     *
     * @param CreateReservaRequest $request
     *
     * @return Response
     */
    public function store(CreateReservaRequest $request)
    {
        $input = $request->all();
        $input['fecha'] = Carbon::createFromFormat('d-m-Y', $input['fecha'])->toDateString();
        $input['user_id'] = Auth::user()->id;
        $reserva = $this->reservaRepository->create($input);
        $reserva->butacas()->sync($request['butacas']);
        $this->reservaRepository->guardarLog("nuevo", $reserva);

        Flash::success('Reserva registrada.');

        return redirect(route('admin.reservas.index'));
    }

    /**
     * Display the specified Reserva.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reserva = $this->reservaRepository->findWithoutFail($id);

        if (empty($reserva)) {
            Flash::error('Reserva not found');

            return redirect(route('admin.reservas.index'));
        }

        return view('admin.reservas.show')->with('reserva', $reserva);
    }

    /**
     * Show the form for editing the specified Reserva.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reserva = $this->reservaRepository->findWithoutFail($id);

        if (empty($reserva)) {
            Flash::error('Reserva not found');

            return redirect(route('admin.reservas.index'));
        }

        $butacas_reservadas = array();
        foreach ($reserva->butacas as $butaca) {
            array_push($butacas_reservadas, $butaca->id);
        }
        $butacas = $this->reservaRepository->getButacasLibres($reserva->fecha, $reserva->id);

        return view('admin.reservas.edit')->with([
            'reserva' => $reserva,
            'butacas' => $butacas,
            'butacas_reservadas' => $butacas_reservadas
        ]);

    }

    /**
     * Update the specified Reserva in storage.
     *
     * @param  int $id
     * @param UpdateReservaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservaRequest $request)
    {
        $reserva = $this->reservaRepository->findWithoutFail($id);

        if (empty($reserva)) {
            Flash::error('Reserva not found');

            return redirect(route('admin.reservas.index'));
        }

        $request['fecha'] = Carbon::createFromFormat('d-m-Y', $request['fecha'])->toDateString();
        $reserva = $this->reservaRepository->update($request->all(), $id);
        $reserva->butacas()->sync($request['butacas']);
        $this->reservaRepository->guardarLog("edicion", $reserva);

        Flash::success('Reserva registrada.');

        return redirect(route('admin.reservas.index'));
    }

    /**
     * Remove the specified Reserva from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reserva = $this->reservaRepository->findWithoutFail($id);

        if (empty($reserva)) {
            Flash::error('Reserva not found');

            return redirect(route('admin.reservas.index'));
        }

        DB::table('reserva_butaca')->where('reserva_id', $id)->delete();
        $this->reservaRepository->delete($id);
        $this->reservaRepository->guardarLog("eliminar", $reserva);
        Flash::success('Reserva eliminada.');

        return redirect(route('admin.reservas.index'));
    }
}
