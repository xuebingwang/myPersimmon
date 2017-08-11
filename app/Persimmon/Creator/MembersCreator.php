<?php

namespace Persimmon\Creator;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Models\Members;

class MembersCreator
{

    public function login(Request $request){

        $member = Members::where('mobile',$request->get('mobile'))->first();

        if(empty($member) || !Hash::check($request->input('password'),$member->password)){

            return false;
        }

        $member->last_login = NOW;
        $member->save();

        $member->domain = (empty($member->domain) ? ('/mid/'.$member->id) : $member->domain);
        session(['member_auth'=>$member]);

        return $member;

    }

    public function resetPassword(Request $request){

        return Members::where('mobile',$request->input('mobile'))
            ->update(['password'=>bcrypt($request->input('password'))]);
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
        $member->name = substr_replace($member->mobile,'****',3,4);

        $member->avatar = 'http://'.config('filesystems.disks.qiniu.domains.custom').'/avatar-'.mt_rand(1,26).'.png';
        $member->desc = __('cateyeart.member_desc');

        return $member;
    }

}