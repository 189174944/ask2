<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'ask_users';
    protected $fillable = [
        'id', 'account', 'password', 'is_special', 'special_id', 'nickname', 'sex', 'occupation', 'short_sign', 'long_sign', 'register_from', 'wechat_qrcode', 'created_at'
    ];
    public $timestamps = false;

    public function topic()
    {
        return $this->belongsToMany(TopicModel::class, 'ask_users_topic', 'users_id', 'topic_id');
    }

    public function special()
    {
        return $this->hasOne(SpecialModel::class, 'id', 'is_special');
    }

//    用户关注的作者
    public function author()
    {
        return $this->belongsToMany(UsersModel::class, 'ask_users_author', 'users_id', 'author_id');
    }

//    作者拥有的粉丝
    public function fans()
    {
        return $this->belongsToMany(UsersModel::class, 'ask_users_author', 'author_id', 'users_id');
    }
}
