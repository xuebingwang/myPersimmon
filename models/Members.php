<?php

namespace Models;

use App\CatEyeArt\Common;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Members extends Authenticatable
{
    use HasApiTokens,Notifiable;

    static $sex_array =[
        'm'=>'男',
        'f'=>'女',
        's'=>'保密',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getWorks($page_size=null,$page_index=null)
    {

        return Works::
            join('albums as b','works.album_id','=','b.id')
            ->where(['works.mid'=>$this->id,'b.is_public'=>Common::YES])
            ->select('works.*')
            ->orderBy('works.updated_at','desc')
            ->paginate($page_size, ['*'], 'page_index', $page_index);

    }
}
