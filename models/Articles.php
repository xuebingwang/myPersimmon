<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'tech_superarticle_article';

    public $timestamps = false;

}
