<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');

        if ($token == '') {
            return response()->json([
                'result_code' => 0,
                'result_info' => '秘钥未设置!'
            ]);
        } else {
            $result = Redis::exists($token);
            if ($result) {
                Redis::expire($token, 3600 * 24 * 10);
                $uid = Redis::get($token);
                Redis::select(1);
                Redis::expire($uid, 3600 * 24 * 10);
                return $next($request);
            } else {
                return response()->json([
                    'result_code' => -1,//调用后引导用户跳出登陆页面
                    'result_info' => '非法秘钥或秘钥过期'
                ]);
            }
        }
    }
}
