<?php

namespace App\Http\Controllers\App;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Models\Members;
use Persimmon\Creator\MembersCreator;
use SmsManager;


class MemberController extends Controller
{

    protected $member;
    public function __construct(){


    }

    public function index(Request $request){

        if($request->getMethod() == 'AJAX'){

            $this->success($this->member);

            return $request->json($this->response);
        }else{

            return view('app.member.index');
        }
    }
}