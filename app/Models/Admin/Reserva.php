<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reserva
 * @package App\Models\Admin
 * @version July 6, 2018, 11:49 am UTC
 *
 * @property date fecha
 * @property integer numero_personas
 * @property integer user_id
 */
class Reserva extends Model
{

    public $table = 'reservas';
    


    public $fillable = [
        'fecha',
        'numero_personas',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
        'numero_personas' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function butacas()
    {
        return $this->belongsToMany('App\Models\Admin\Butaca','reserva_butaca');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Admin\User');
    }
}
