<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Services\ActionLogsService;

class RbacAuth
{
    protected $actionLogsService;

    /**
     * RbacAuth constructor.
     * @param $actionLogsService
     */
    public function __construct(ActionLogsService $actionLogsService)
    {
        $this->actionLogsService = $actionLogsService;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**判断登录用户是否已经登录*/
        if(!Auth::guard('admin')->check())
        {
            return redirect()->route('login');
        }

        /**紀錄USER操作行為**/
        if(in_array($request->method(),['POST','PUT','PATCH','DELETE']))
        {
            $this->actionLogsService->mudelActionLogCreate($request);
        }

        if(!Auth::guard('admin')->user()->hasRule(\Route::currentRouteName()))
        {
            if ($request->ajax()){
                return response()->json([
                    'status' => -1,
                    'code'   => 403,
                    'msg'    => '您沒有權限操作',
                    'Message'=>'您沒有權限操作',
                ],403);
            }else{
                return viewError(trans('message.non_permiss'),'index.index');
            }


        }

        return $next($request);
    }
}
