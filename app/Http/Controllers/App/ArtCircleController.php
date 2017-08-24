<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Models\Albums;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberVerify;
use Models\Works;
use Qiniu\Auth;


class ArtCircleController extends MemberController
{

    public function index(Request $request){

        $member = $this->getMember();
        $list = [];
        return view('app.artcircle.index')->with(compact('list','member'));
    }
    public function add(){

        return view('app.artcircle.add');
    }
}