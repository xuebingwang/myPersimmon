<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $member = session('member_auth');
        if(empty($member)){
            $url = route('login',['backurl'=>urlencode(base64_encode($request->url()))]);
            if($request->ajax()){

                return response()->json(['status'=>99999,'msg'=>__('auth.has_no_login'),'url'=>$url]);
            }else{

                return redirect($url)->withErrors(__('auth.has_no_login'));
            }
        }

        return $next($request);
    }
}
