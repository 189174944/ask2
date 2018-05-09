<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersAuthorModel extends Model
{
    protected $table = 'ask_users_author';
    protected $fillable = [
        'users_id','author_id','created_at'
    ];
}
