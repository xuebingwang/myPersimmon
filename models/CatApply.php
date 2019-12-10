<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class CatApply extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'cat_apply';

    public $timestamps = false;

}
