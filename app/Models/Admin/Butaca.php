<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Butaca
 * @package App\Models\Admin
 * @version July 6, 2018, 11:50 am UTC
 *
 * @property integer fila
 * @property integer columna
 */
class Butaca extends Model
{

    public $table = 'butacas';

    public $fillable = [
        'fila',
        'columna'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fila' => 'integer',
        'columna' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getFullNameAttribute()
    {
        return "fila  {$this->fila} / columna {$this->columna}";
    }


    public function Reservas()
    {
        return $this->belongsToMany('App\Models\Admin\Reserva','reserva_butaca');
    }
    
}
