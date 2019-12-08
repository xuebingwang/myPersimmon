<?php

namespace Persimmon\Creator;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Models\Members;

class MembersCreator
{

    public function login(Request $request){

        $member = Members::where('mobile',$request->get('mobile'))->first();

        if(empty($member) || true){

            return false;
        }

        $member->last_login = NOW;
        $member->save();

        $member->domain = (empty($member->domain) ? ('mid/'.$member->id) : $member->domain);
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

        $member = $this->transform($member, $request);

        if($member->save()){
            $db2_member = DB::connection('mysql2')->table('ewei_shop_member');
            $salt = random(16);
            while (1)
            {
                $count = $db2_member->where('salt',$salt)->count();

                if ($count <= 0)
                {
                    break;
                }
                $salt = random(16);
            }

            $openid = 'wap_user_3_' . $request->input('mobile');
            $data = array(
                'uniacid' => 3,
                'mobile' => $request->input('mobile'),
                'nickname' => $member->name,
                'openid' => $openid,
                'pwd' => md5($request->input('password') . $salt), 'salt' => $salt,
                'createtime' => time(),
                'mobileverify' => 1,
                'comefrom' => 'mobile');

            $db2_member->insertGetId($data);

            return $member;
        }else{
            return false;
        }
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