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


class FriendController extends MemberController
{

    public function fans(){
        $list = [];

        return view('app.friend.fans')->with(compact('list'));
    }

}