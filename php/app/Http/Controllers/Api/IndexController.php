<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticalModel;

class IndexController extends Controller
{
    public function index()
    {
//        $artical = ArticalModel::select('type','title','content')->with(['users' => function ($query) {
//            $query->select('id', 'nickname', 'avatar');
//        }, 'topic', 'users.special'])->paginate();
//        select(['title', 'content', 'users_id','created_at'])->
        $artical = ArticalModel::with(['topic', 'users.special', 'users' => function ($query) {
            $query->select(['id', 'nickname', 'avatar', 'is_special']);
        }])->paginate();

        return response()->json([
            'code' => 1,
            'info' => '获取成功',
            'data' => $artical
        ]);
    }
}
