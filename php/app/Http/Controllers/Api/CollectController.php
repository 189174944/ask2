<?php

namespace App\Http\Controllers\Api;

use App\Models\ArticalCollectDir;
use App\Models\ArticalCollectItem;
use App\Models\QuestionCollectDir;
use App\Models\QuestionCollectItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
    public function articalDir(Request $request)
    {
        $method = $request->method();
        $users_id = $request->get('users_id');
        if ($method == 'GET') {
            $data = ArticalCollectDir::where('users_id', $users_id)->get();
            return response()->json([
                'code' => 0,
                'info' => '',
                'data' => $data
            ]);
        } elseif ($method == 'POST') {
            if ($request->get('action') == 'update') {
                $name = $request->get('name');
                $updateResult = ArticalCollectDir::where('id', $request->get('id'))->update([
                    'name' => $name
                ]);
                if ($updateResult) {
                    return response()->json([
                        'code' => 1,
                        'info' => '更新成功',
                    ]);
                } else {
                    return response()->json([
                        'code' => 0,
                        'info' => '更新失败',
                    ]);
                }
            } elseif ($request->get('action') == 'delete') {
                $result = ArticalCollectDir::where('id', $request->get('id'))->delete();
                ArticalCollectItem::where('collect_id', $request->get('id'))->delete();
                if ($result) {
                    return response()->json([
                        'code' => 1,
                        'info' => '删除成功',
                    ]);
                }else{
                    return response()->json([
                        'code' => 0,
                        'info' => '未知错误',
                    ]);
                }
            } else {
                $name = $request->get('name');
                $articalDir = new ArticalCollectDir();
                $articalDir->fill([
                    'users_id' => $users_id,
                    'name' => $name,
                ]);
                if ($articalDir->save()) {
                    return response()->json([
                        'code' => 1,
                        'info' => '添加成功',
                    ]);
                }
            }
        }
    }

    public function questionDir(Request $request)
    {
        $method = $request->method();
        $users_id = $request->get('users_id');
        if ($method == 'GET') {
            $data = QuestionCollectDir::where('users_id', 1)->get();
            return response()->json([
                'code' => 0,
                'info' => '',
                'data' => $data
            ]);
        } elseif ($method == 'POST') {
            if ($request->get('action') == 'update') {
                $name = $request->get('name');
                $updateResult = QuestionCollectDir::where('id', $request->get('id'))->update([
                    'name' => $name
                ]);
                if ($updateResult) {
                    return response()->json([
                        'code' => 1,
                        'info' => '更新成功',
                    ]);
                } else {
                    return response()->json([
                        'code' => 0,
                        'info' => '更新失败',
                    ]);
                }
            } elseif ($request->get('action') == 'delete') {
                $result = QuestionCollectDir::where('id', $request->get('id'))->delete();
                QuestionCollectDir::where('collect_id', $request->get('id'))->delete();
                if ($result) {
                    return response()->json([
                        'code' => 1,
                        'info' => '删除成功',
                    ]);
                }else{
                    return response()->json([
                        'code' => 0,
                        'info' => '未知错误',
                    ]);
                }
            } else {
                $name = $request->get('name');
                $articalDir = new QuestionCollectDir();
                $articalDir->fill([
                    'users_id' => $users_id,
                    'name' => $name,
                ]);
                if ($articalDir->save()) {
                    return response()->json([
                        'code' => 1,
                        'info' => '添加成功',
                    ]);
                }
            }
        }
    }

    public function articalItem(Request $request)
    {
        $method = $request->method();
        $users_id = $request->get('users_id');
        if ($method == 'GET') {
            $data = ArticalCollectItem::where('collect_id', $users_id)->get();
            return response()->json([
                'code' => 0,
                'info' => '',
                'data' => $data
            ]);
        } elseif ($method == 'POST') {
            if ($request->get('action') == 'delete') {
                $result = ArticalCollectItem::where('id', $request->get('id'))->delete();
                if ($result) {
                    return response()->json([
                        'code' => 1,
                        'info' => '删除成功',
                    ]);
                }else{
                    return response()->json([
                        'code' => 0,
                        'info' => '未知错误',
                    ]);
                }
            } else {
                $collect_id = $request->get('collect_id');
                $artical_id = $request->get('artical_id');
                $articalCollectItem = new ArticalCollectItem();
                $articalCollectItem->fill([
                    'collect_id' => $collect_id,
                    'artical_id' => $artical_id,
                ]);
                if ($articalCollectItem->save()) {
                    return response()->json([
                        'code' => 1,
                        'info' => '添加成功',
                    ]);
                }
            }
        }
    }

    public function questionItem(Request $request)
    {
        $method = $request->method();
        $users_id = $request->get('users_id');
        if ($method == 'GET') {
            $data = QuestionCollectItem::where('collect_id', $users_id)->get();
            return response()->json([
                'code' => 0,
                'info' => '',
                'data' => $data
            ]);
        } elseif ($method == 'POST') {
            if ($request->get('action') == 'delete') {
                $result = QuestionCollectItem::where('id', $request->get('id'))->delete();
                if ($result) {
                    return response()->json([
                        'code' => 1,
                        'info' => '删除成功',
                    ]);
                } else {
                    return response()->json([
                        'code' => 0,
                        'info' => '未知错误',
                    ]);
                }
            } else {
                $collect_id = $request->get('collect_id');
                $artical_id = $request->get('artical_id');
                $QuestionCollectItem = new QuestionCollectItem();
                $QuestionCollectItem->fill([
                    'collect_id' => $collect_id,
                    'artical_id' => $artical_id,
                ]);
                if ($QuestionCollectItem->save()) {
                    return response()->json([
                        'code' => 1,
                        'info' => '添加成功',
                    ]);
                }
            }
        }
    }
}
