<?php

namespace Persimmon\Creator;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Models\Members;

class MembersCreator
{

    public function login(Request $request){

        $member = Members::where('mobile',$request->get('mobile'))->first();

        if(!empty($member) && !Hash::check($request->input('password'),$member->password)){

            return false;
        }

        unset($member->password);

        session(['member_auth'=>$member]);
        return $member;

    }

    public function create(Request $request)
    {
        $member = new Members();

        return $this->transform($member, $request)->save();
    }

    public function transform(Members $member, Request $request)
    {

        $member->mobile = $request->get('mobile');
        $member->reg_ip = $request->ip();
        $member->password = bcrypt($request->input('password'));

        $member->avator = 'avator-'.mt_rand(1,26).'.png';

        return $member;
    }


}