<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Groups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Session::get("account"))){
            return redirect()->to('admin/login');
        }
        $groups = Groups::all();
        $admin = Admin::with('groups')->paginate();
        return view('admin.admin', compact('admin', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = $request->get('account');
        $count = Admin::where('account', $account)->count();
        $realname = $request->get('realname');
        $groups_id = $request->get('groups_id');
        if ($count > 0) {
            return response()->json([
                'result_code' => 0,
                'result_info' => '管理员账号不能重复'
            ]);
        } else {
            $admin = new Admin();
            $admin->fill([
                'groups_id' => $groups_id,
                'realname' => $realname,
                'account' => $account,
                'password' => Hash::make($request->get('password')),
                'register_time'=>date("Y-m-d H:i:s",time())
            ]);
            if ($admin->save()) {
                return response()->json([
                    'result_code' => 1,
                    'result_info' => '添加管理员成功'
                ]);
            } else {
                return response()->json([
                    'result_code' => 0,
                    'result_info' => '添加管理员失败'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Groups::all();
        $admin = Admin::find($id);
        return view('admin.admin_edit', compact('admin', 'id', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $password = Hash::make($request->get('password'));
        $r = Admin::where('id', $id)->update([
            'password' => $password,
            'groups_id' => $request->get('groups_id')
        ]);
        if ($r) {
            return response()->json([
                'result_code' => 1,
                'result_info' => '更新密码成功'
            ]);
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '更新密码失败'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
