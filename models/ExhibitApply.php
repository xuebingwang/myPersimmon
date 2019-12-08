<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitApply extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'exhibit_apply';

    public $timestamps = false;

}
