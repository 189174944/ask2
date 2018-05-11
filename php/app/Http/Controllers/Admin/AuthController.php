<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            App::setLocale('cn');
            return view('admin.login');
        }
        if ($request->isMethod('post')) {
            $account = $request->get('account');
            $password = $request->get('password');
            if (empty($account) || empty($password)) {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '账号或密码不能为空!'
                ]);
            }
            $admin = Admin::where('account', $account);
            $count = $admin->count();
            if ($count > 0) {
                $groups_id = $admin->first()->groups_id;
                if (Hash::check($password, $admin->first()->password)) {
                    $admin->update(['last_login' => date("Y-m-d H:i:s", time())]);
                    Session::put([
                        'account' => $account,
                        'groups_id' => $groups_id,
                        'is_super_admin' => ($groups_id == 1 ? 1 : 0)
                    ]);
                    if ($admin->first()->allow_login == 1) {
                        return response()->json([
                            'result_code' => 1,
                            'is_super_admin' => ($groups_id == 1 ? 1 : 0),
                            'result_info' => '登陆成功'
                        ]);
                    } else {
                        return response()->json([
                            'result_code' => 0,
                            'result_info' => '锁定中'
                        ]);
                    }
                } else {
                    return response()->json([
                        'result_code' => 0,
                        'result_info' => '密码不正确'
                    ]);
                }
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '账号不存在'
                ]);
            }
        }
    }

    public function logout()
    {
        Session::flush("account");
        Session::flush("groups_id");
        return redirect()->to('admin/login');
    }
}
