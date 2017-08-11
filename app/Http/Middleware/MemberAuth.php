<?php

namespace App\Http\Middleware;

use Closure;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $member = session('member_auth');
        if(empty($member)){
            if($request->ajax()){

                return response()->json(['status'=>99999,'msg'=>__('auth.has_no_login'),'url'=>route('login')]);
            }else{

                return redirect('login')->withErrors(__('auth.has_no_login'));
            }
        }

        return $next($request);
    }
}
