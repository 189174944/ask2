<?php

namespace App\Http\Controllers\Api;

use App\Models\TopicModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    //用户资料
    public function getUserInfo()
    {
        return response()->json([
            'code' => 10001,
            'info' => 'ok',
            'data' => [
                'users_id' => '',
                'nickname' => '',
                'token' => '',
            ]
        ]);
    }

    //我关注的
    public function getIFollow()
    {
        $sex = 1;

        return response()->json([
            'code' => 10001,
            'info' => 'ok',
            'data' => [
                [
                    'users_id' => '',
                    'nickname' => '',
                    'avatar' => '头像地址',
                    'default_avatar_type' => $sex,
                    'created_at' => '2018-4-24'           //关注时间
                ],
                [
                    'users_id' => '',
                    'nickname' => '',
                    'avatar' => '头像地址',
                    'default_avatar_type' => $sex,
                    'created_at' => '2018-4-24'           //关注时间
                ],
                [
                    'users_id' => '',
                    'nickname' => '',
                    'avatar' => '头像地址',
                    'default_avatar_type' => $sex,
                    'created_at' => '2018-4-24'           //关注时间
                ]
            ]
        ]);
    }

    //关注我的
    public function getFollowI()
    {
        return response()->json([
            'code' => 10001,
            'info' => 'ok',
            'data' => [
                'users_id' => '',
                'nickname' => '',
                'token' => '',
            ]
        ]);
    }

    public function getTopic(Request $request)
    {
        $user_id = $request->get('users_id');
        $result = \App\Models\UsersModel::where('id', $user_id)->select('id')->with(['topic' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        return response()->json($result);
    }
    //关注/取消关注话题
    //收藏/取消收藏问题/文章
//    发布文章
//    更新文章

//获取问题收藏夹
//获取文章收藏夹
}
