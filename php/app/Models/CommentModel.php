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
        'updated_at'
    ];
    public function users(){
        return $this->belongsTo(UsersModel::class,'users_id','id');
    }
}
