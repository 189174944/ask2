<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticalCollectItem extends Model
{
    protected $table = 'ask_artical_collect_item';
    public $timestamps = false;
    protected $fillable = [
        'id','artical','collect_id','created_at'
    ];
}