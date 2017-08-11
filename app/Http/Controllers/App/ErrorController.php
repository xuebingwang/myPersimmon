<?php

namespace App\Http\Controllers\App;


class ErrorController extends Controller
{

    public function noFound(){
        return view('app.error.404')->with(['class'=>session('class','Text1'),'msg'=>session('msg','您要找的页面不存在~')]);
    }
}