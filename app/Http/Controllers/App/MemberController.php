<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Models\Members;


class MemberController extends Controller
{

    protected $member;

    /**
     * @return mixed
     */
    protected function getMember(){
        if(empty($this->member)){

            $this->member = session('member_auth');
        }

        if(empty($this->member)){
            $this->member = new Members();
        }

        return $this->member;
    }

    public function index(Request $request){

        if($request->getMethod() == 'AJAX'){

            $this->success($this->getMember());

            return $request->json($this->response);
        }else{

            return view('app.member.index')->with(['member'=>$this->getMember()]);
        }
    }
}