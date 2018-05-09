<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCollectDir extends Model
{
    protected $table = 'ask_question_collect_dir';
    public $timestamps = false;
    protected $fillable = [
        'id', 'users_id', 'name'
    ];
}
