<?php

namespace App\Http\Controllers\App;


use Illuminate\Http\Request;
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

        return view('app.auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSignupForm(){

        return view('app.auth.signup');
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

            $this->success([],'登录成功!',route('member_index'));
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
            'password'     => 'required',
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForgotPasswordForm(){

        return view('app.auth.forgot_password');
    }
}