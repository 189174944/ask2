<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppFocus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AppFocusController extends Controller
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
        $appFocus = AppFocus::all();
        return view('admin.app_focus', compact('appFocus'));
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
        $appfocus = new AppFocus();
        $appfocus->fill($request->except('_token'));
        if ($appfocus->save()) {
            return response()->json([
                'result_code' => 1,
                'result_info' => '添加成功!'
            ]);
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '添加失败!'
            ]);
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
        $appFocus = AppFocus::find($id);
        return view('admin.app_focus_edit', compact('appFocus'));
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
        $result = AppFocus::where('id', $id)->update($request->except('_token'));
        if ($result) {
            return response()->json([
                'result_code' => 1,
                'result_info' => '更新成功!'
            ]);
        } else {
            return response()->json([
                'result_code' => 0,
                'result_info' => '更新失败!'
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
