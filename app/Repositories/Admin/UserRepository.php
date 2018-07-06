<?php

namespace App\Repositories\Admin;

use App\Models\Admin\User;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Admin
 * @version July 6, 2018, 11:48 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function controlUser($user_id)
    {
        $user = DB::table('reservas')->where('user_id', $user_id)->first();
        if ($user) {
            return false;
        } else {
            return true;
        }
    }

    public function getUsersFilter($parametros)
    {
        $users = User::from('users as u');
        if ($parametros['buscar'] != '') {
            $users->where(function ($query) use ($parametros) {
                $query->orWhere('u.name', 'LIKE', "%" . $parametros['buscar'] . "%")
                    ->orWhere('u.last_name', 'LIKE', "%" . $parametros['buscar'] . "%");
            }
            );
        }
        return $users->paginate(10);

    }
}
