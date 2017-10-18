<?php

namespace App\Http\Controllers\App;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Models\Members;
use Persimmon\Creator\MembersCreator;
use SmsManager;


class AuthController extends Controller
{

    protected $creator;
    public function __construct(MembersCreator $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(Request $request){
//        Log::debug('哈哈');

        return view('app.auth.login')->with(['backurl'=>$request->get('backurl')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSignupForm(){

        return view('app.auth.signup');
    }


    public function logout(Request $request){
        $request->session()->flush();

        $key = '__ewei_shopv2_member_session_3';
        setcookie('14c8_'.$key,false,-100,"/",env('MAIN_DOMAIN'));

        if($request->isMethod('ajax')){

            $this->success([],__('auth.logout_success'));
            return $request->json($this->response);

        }else{

            return redirect('login')->with('message',__('auth.logout_success'));
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required',
            'password'     => 'required',
            //more...
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->all());
        }elseif($this->creator->login($request)){

            //与商城系统实现单点登录
            $member = DB::connection('mysql2')->table('ewei_shop_member')->where('mobile',$request->input('mobile'))->first();
            if (!empty($member))
            {
                $member = (array)$member;
                $member['ewei_shopv2_member_hash'] = md5($member['pwd'] . $member['salt']);
                $key = '__ewei_shopv2_member_session_' . $member['uniacid'];
                $cookie = base64_encode(json_encode($member));

                setcookie('14c8_'.$key,$cookie,time()+(7*86400),"/",env('MAIN_DOMAIN'));
            }

            $backurl = $request->input('backurl');
            if(!empty($backurl)){
                $backurl = base64_decode(urldecode($backurl));
            }
            $this->success([],'登录成功!',empty($backurl) ? route('member_index') : $backurl);
        }else{
            $this->error('用户名或密码不正确!');
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|unique:members,mobile',
            'password'     => 'required|min:6|max:20',
            'verify_code' => 'required|verify_code',
            //more...
        ]);

        if ($validator->fails()) {
            //验证失败后建议清空存储的发送状态，防止用户重复试错

            $this->error($validator->errors()->all());
        }elseif($this->creator->create($request)){

//            SmsManager::forgetState();
            $this->success([],'注册成功,感谢您的加入!',route('login'));
        }else{
            $this->error('注册失败,请重新再试或联系客户人员!');
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|exists:members,mobile',
            'password'     => 'required|min:6|max:20',
            'verify_code' => 'required|verify_code',
            //more...
        ]);

        if ($validator->fails()) {
            //验证失败后建议清空存储的发送状态，防止用户重复试错

            $this->error($validator->errors()->all());
        }elseif($this->creator->resetPassword($request)){
//            SmsManager::forgetState();
            $this->success([],'重置成功,请使用新密码登录!',route('login'));
        }else{
            $this->error('重置失败,请重新再试或联系客户人员!');
        }

        return response()->json($this->response);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForgotPasswordForm(){

        return view('app.auth.forgot_password');
    }
}