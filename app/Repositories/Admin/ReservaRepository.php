<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Butaca;
use App\Models\Admin\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReservaRepository
 * @package App\Repositories\Admin
 * @version July 6, 2018, 11:49 am UTC
 *
 * @method Reserva findWithoutFail($id, $columns = ['*'])
 * @method Reserva find($id, $columns = ['*'])
 * @method Reserva first($columns = ['*'])
 */
class ReservaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'numero_personas',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Reserva::class;
    }

    public function getReservasFilter($parametros)
    {
        $reservas = Reserva::from('reservas')
            ->where('user_id', Auth::user()->id);
        if ($parametros['fecha'] != "") {
            $fecha = Carbon::createFromFormat('d-m-Y', $parametros['fecha'])->toDateString();
            $reservas->whereDate('fecha', $fecha);
        }
        return $reservas->paginate(10);

    }

    public function guardarLog($operacion, $reserva)
    {
        $reserva_log['operacion'] = $operacion;
        $reserva['butacas'] = $reserva->butacas;
        $reserva_log['reserva'] = $reserva;
        $reserva_log = json_encode($reserva_log);

        Log::useDailyFiles(storage_path() . '/logs/reservas.log');
        Log::info($reserva_log);
        return;
    }

    public function getButacasLibres($fecha, $reserva_id)
    {
        $where = ($reserva_id) ? " and r.id<>" . $reserva_id : "";
        $butacas = Butaca::from('butacas as b')
            ->whereNotIn('b.id', [DB::raw(
                "select distinct(rb.butaca_id) from reserva_butaca as rb join reservas as r on r.id=rb.reserva_id where r.fecha='" . $fecha . "'" . $where
            )])
            ->select('b.*')
            ->get()->pluck('full_name', 'id');


        return $butacas;

    }
}
