<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticalCollectDir extends Model
{
    protected $table = 'ask_artical_collect_dir';
    public $timestamps = false;
    protected $fillable = [
        'id','users_id','name'
    ];
}

