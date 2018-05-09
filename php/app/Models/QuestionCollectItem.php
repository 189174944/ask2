<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCollectItem extends Model
{
    protected $table = 'ask_question_collect_item';
    public $timestamps = false;
    protected $fillable = [
        'id','users_id','collect_id','created_at'
    ];
}

