<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticalModel extends Model
{
    protected $table = 'ask_artical';
    protected $fillable = [
        'id', 'users_id', 'type', 'title', 'content', 'coverpic', 'status', 'price', 'is_blocked', 'blocked_reason', 'visitornum', 'is_anonymous', 'latest_comment', 'is_lock', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function topic()
    {
        return $this->belongsToMany(TopicModel::class, 'ask_article_topic', 'artical_id', 'topic_id');
    }

    public function users()
    {
        return $this->belongsTo(UsersModel::class, 'users_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(CommentModel::class, 'artical_id', 'id');
    }
}
