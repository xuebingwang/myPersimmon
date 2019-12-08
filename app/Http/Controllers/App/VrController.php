<?php

namespace App\Http\Controllers\App;


use App\CatEyeArt\Common;
use Models\Links;
use Models\Members;
use Models\MemberStars;
use Models\WorkLikes;
use Models\Works;
use Persimmon\Services\SiteMap;
use Persimmon\Services\RssFeed;
use Models\Categorys;
use Models\Posts;
use Models\Tags;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;

class HomeController extends MemberController
{

    public function showList($cate=''){

        return view('app.home.yizhan');
    }
}