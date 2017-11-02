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

            $backurl = '';
            if($request->getMethod() == 'AJAX'){
                $backurl = urlencode(base64_encode($request->url()));
            }
            $url = route('login',['backurl'=>$backurl]);
            if($request->ajax()){

                return response()->json(['status'=>99999,'msg'=>__('auth.has_no_login'),'url'=>$url]);
            }else{

                return redirect($url)->withErrors(__('auth.has_no_login'));
            }
        }

        return $next($request);
    }
}
