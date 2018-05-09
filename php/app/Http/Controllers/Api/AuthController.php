<?php

namespace App\Http\Controllers\Api;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $mobile = trim($request->get('mobile'));
        $verifyCode = trim($request->get('verifycode'));
        $password = trim($request->get('password'));
        $device = $request->get('device');
        if (empty($mobile) || empty($password) || empty($verifyCode)) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '帐号密码验证码不能为空!'
            ]);
        }
        $count = UsersModel::where('mobile', $mobile)->count();
        if ($count > 0) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '注册失败！该帐号已存在!'
            ]);
        } else {
            if (Redis::get($mobile) == $verifyCode) {
                $users = new UsersModel();
                $users->fill([
                    'mobile' => $mobile,
                    'password' => Hash::make($password),
                    'register_device' => $device
                ]);
                if ($users->save()) {
                    Redis::del($mobile);//注册成功后,从redis删除验证码
                    return response()->json([
                        'result_code' => 1,
                        'result_info' => '注册成功!'
                    ]);
                }
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '验证码不正确或已失效!'
                ]);
            }
        }
    }

    function login(Request $request)
    {
        $mobile = $request->get('account');
        $password = $request->get('password');
//        $login_device = $request->get('login_device') or '';
//        $register_device = $request->get('register_device') or '';
        $user = UsersModel::where(['account' => $mobile]);
        if ($user->count() > 0) {
            if (!$user->first()->allow_login){
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '账号已被屏蔽',
                ]);
            }
            if (Hash::check($password, $user->first()->password)) {
                $uid = $user->first()->id;
                Redis::select(1);
                $result = Redis::get($uid) ? true : false;
                if ($result) {
                    $existsToken = Redis::get($uid);
                    Redis::select(0);
                    Redis::del($existsToken);
                    $token = md5(time() + rand(1000, 9999));
                    Redis::set($token, json_encode($uid));
                    Redis::expire($token, 3600 * 24 * 10);
                    Redis::select(1);
                    Redis::set($uid, $token);
                    Redis::expire($uid, 3600 * 24 * 10);
                } else {
                    Redis::select(0);
                    $token = md5(time() + rand(1000, 9999));
                    Redis::set($token, json_encode($uid));
                    Redis::expire($token, 3600 * 24 * 10);
                    Redis::select(1);
                    Redis::set($uid, $token);
                    Redis::expire($uid, 3600 * 24 * 10);
                }
                return response()->json([
                    'result_code' => 1,
                    'result_info' => '登陆成功',
                    'data' => [
                        'user_id' => $uid,
                        'token' => $token
                    ]
                ]);
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '密码错误',
                ]);
            }
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '登陆失败，账号不存在!',
            ]);
        }

    }

    public function modify(Request $request)
    {
//        账号是11位手机号
//        密码不得超过20位
        $mobile = $request->get('mobile');
        $oldPassword = $request->get("oldpassword");
        $newPassword = $request->get("newpassword");
        if (empty($mobile)) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '手机号不能为空!',
            ]);
        } else {
            if (strlen($mobile) > 11) {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '非法手机号!',
                ]);
            }
        }
        if (empty($oldPassword)) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '旧密码不能为空!',
            ]);
        }
        if (empty($newPassword)) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '新密码不能为空!',
            ]);
        } else {
            if (strlen($newPassword) > 20 || strlen($newPassword) < 6) {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '密码的长度在6～20位之间!',
                ]);
            }
        }
        $users = UsersModel::where('mobile', $mobile);
        if ($users->count() > 0) {
            $realPassword = $users->first()->password;
            if (Hash::check($oldPassword, $realPassword)) {
                UsersModel::where('mobile', $mobile)->update([
                    'password' => Hash::make($newPassword)
                ]);
                return response()->json([
                    'result_code' => 1,
                    'result_info' => '密码修改成功!',
                ]);
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '旧密码错误!',
                ]);
            }
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '该账号不存在!',
            ]);
        }
    }

    //找回密码
    public function forgotPassword(Request $request)
    {
        $mobile = $request->get('mobile');
        $password = $request->get('password');
        $verifyCode = $request->get('verify_code');
        $correctVerifyCode = Redis::get($mobile);
        if ($verifyCode == $correctVerifyCode) {
            $users = UsersModel::where('mobile', $mobile);
            if ($users->count() > 0) {
                UsersModel::where('mobile', $mobile)->update([
                    'password' => Hash::make($password)
                ]);
                return response()->json([
                    'result_code' => 1,
                    'result_info' => '密码修改成功!',
                ]);
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '该账号不存在!',
                ]);
            }
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '验证码错误!',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('token');
        $users_id = Redis::get($token);
        Redis::del($token);
        Redis::select(1);
        Redis::del($users_id);
        if ($users_id){
            UsersModel::find($users_id)->update([
                'client_id' => ''
            ]);
        }
        return response()->json([
            'result_code' => 1,
            'result_info' => '退出成功',
        ]);
    }
}
