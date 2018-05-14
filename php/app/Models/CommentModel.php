<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'ask_comment';
    protected $fillable = [
        'id',
        'artical_id',
        'users_id',
        'content',
        'created_at',
        'updated_at',
        'status',
        'satisfactory_answer',
        'replyed_id'
    ];
    public function users(){
        return $this->belongsTo(UsersModel::class,'users_id','id');
    }

    public function replyedUsers(){
        return $this->belongsTo(UsersModel::class,'replyed_id','id');
    }
}
