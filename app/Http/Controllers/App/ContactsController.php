<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Models\Albums;
use Models\Categorys;
use Models\ContentPics;
use Models\Contents;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberMoments;
use Models\MemberMomentsStars;
use Models\MemberVerify;
use Models\Msgs;
use Qiniu\Auth;


class ContactsController extends MemberController
{
    private function _get_totals(){

        $member = $this->getMember();
        $total_list = [];
        $total_list['fans'] = MemberStars::where('mid',$member->id)->count();

        $total_list['gz'] = MemberStars::where('follow_id',$this->getMember()->id)
            ->pluck('mid')->all();

        $total_list['friend'] = MemberStars::where('follow_id',$member->id)->whereIn('mid',$total_list['gz'])->count();

        return $total_list;
    }

    public function fans(){
        $list = DB::table('member_stars as a')
            ->join('members as b','a.follow_id','=','b.id')
            ->where('mid',$this->getMember()->id)
            ->select('b.*')
            ->get();

        $menu = 'fans';
        return view('app.contacts.fans',['total_list'=>$this->_get_totals()])
            ->with(compact('list','menu'));
    }

    public function gz(){
        $list = DB::table('member_stars as a')
            ->join('members as b','a.mid','=','b.id')
            ->where('follow_id',$this->getMember()->id)
            ->select('b.*')
            ->get();

        $menu = 'gz';
        return view('app.contacts.fans',['total_list'=>$this->_get_totals()])
            ->with(compact('list','menu'));
    }

    public function friend(){
        $total_list = $this->_get_totals();

        $list = DB::table('member_stars as a')
            ->join('members as b','a.mid','=','b.id')
            ->where('a.follow_id',$this->getMember()->id)
            ->whereIn('a.mid',$total_list['gz'])
            ->select('b.*')
            ->get();

        return view('app.contacts.friend')
            ->with(compact('list','total_list'));
    }

}