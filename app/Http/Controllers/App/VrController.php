<?php

namespace App\Http\Controllers\App;


use Models\Members;
use Models\WorksMain;
use Models\WworksMain;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Client;

class VrController extends MemberController
{

    public function showPictures(Request $request,$cate_id){


        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $model = new WorksMain();

        $list = $model->where(['hideuser_flag'=>0,'flag_publish'=>1,'category'=>$cate_id])
            ->orderBy('create_time','desc')
            ->paginate($input['page_size'], ['*'], 'page_index', $input['page_index']);

//        var_dump($list->keyBy('pk_user_main')->keys()->all());die;
//        $member_list = [];
//        if(!$list->isEmpty()){
//            $member_list = Members::whereIn('id',$list->keyBy('pk_user_main')->keys()->all())->pluck('name','id')->toArray();
//        }

        $vr_url = env('VR_URL');

        if($request->ajax()){
            $html = View::make('app.vr.pictures_ajax', compact('list','vr_url'))->render();
            $this->success(['html'=>$html],'',$list->nextPageUrl());
            return response()->json($this->response);
        }else{
            $cate_model = DB::connection('mysql3')->table('category');

            $vr_cate =$cate_model->where('id',$cate_id)->first();

            return view('app.vr.pictures')->with(compact('list','vr_cate','vr_url'));
        }
    }
}