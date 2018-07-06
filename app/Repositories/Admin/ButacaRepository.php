<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Butaca;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ButacaRepository
 * @package App\Repositories\Admin
 * @version July 6, 2018, 11:50 am UTC
 *
 * @method Butaca findWithoutFail($id, $columns = ['*'])
 * @method Butaca find($id, $columns = ['*'])
 * @method Butaca first($columns = ['*'])
 */
class ButacaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fila',
        'columna'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Butaca::class;
    }

    public function getButacasLibres($fecha, $reserva_id)
    {
        $fecha = Carbon::createFromFormat('d-m-Y', $fecha)->toDateString();

        $where = ($reserva_id) ? " and r.id<>" . $reserva_id : "";
        $butacas = Butaca::from('butacas as b')
            ->whereNotIn('b.id', [DB::raw(
                "select distinct(rb.butaca_id) from reserva_butaca as rb join reservas as r on r.id=rb.reserva_id where r.fecha='" . $fecha . "'" . $where
            )])
            ->select('b.*')
            ->get();
        $arrayButacas = array();
        $i = 0;
        foreach ($butacas as $butaca) {
            $arrayButacas[$i]['nombre'] = $butaca->full_name;
            $arrayButacas[$i]['id'] = $butaca->id;
            $i++;
        }
        return $arrayButacas;

    }

    public function controlButaca($butaca_id)
    {
        $butaca = DB::table('reserva_butaca')->where('butaca_id', $butaca_id)->first();
        if ($butaca) {
            return false;
        } else {
            return true;
        }
    }

    public function controlButacaRepetidaEdit($fila, $columna, $butaca_id)
    {
        $butaca = DB::table('butacas')
            ->where('columna', $columna)
            ->where('fila', $fila)
            ->where('id', '<>', $butaca_id)
            ->first();
        if ($butaca) {
            return false;
        } else {
            return true;
        }
    }
}
