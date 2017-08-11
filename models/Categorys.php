<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{

    public static function getListByPid($pid){

        return self::where('category_parent',$pid)->get()->toArray();
    }
}
