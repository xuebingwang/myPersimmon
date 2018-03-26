<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Models\Albums;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberMoments;
use Models\MemberMomentsStars;
use Models\MemberVerify;
use Models\Msgs;
use Models\Works;
use Qiniu\Auth;


class ArtCircleController extends MemberController
{

    public function latest(Request $request){


        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $member = $this->getMember();
        $list = MemberMoments::
        join('members as b','member_moments.mid','=','b.id')
            ->where(['b.status'=>Common::STATUS_OK])
            ->orderBy('member_moments.created_at','desc')
            ->paginate($input['page_size'], ['member_moments.*','b.name as member_name','b.avatar'], 'page_index', $input['page_index']);

        $star_list = MemberStars::
            where('follow_id',$member->id)
            ->whereIn('mid',$list->keyBy('mid')->keys()->all())
            ->pluck('mid')->all();

        //增加浏览次数
        MemberMoments::whereIn('id',$list->keyBy('id')->keys()->all())->increment('visits',1);


        if($request->ajax()){
            $html = View::make('app.artcircle.art_circle_ajax', compact('list','member','star_list'))->render();
            $this->success(['html'=>$html],'',$list->nextPageUrl());
            return response()->json($this->response);
        }else{

            return view('app.artcircle.latest')->with(compact('list','member','star_list'));
        }
    }
    public function recommend(Request $request){


        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $member = $this->getMember();
        $list = MemberMoments::
        join('members as b','member_moments.mid','=','b.id')
            ->where(['b.status'=>Common::STATUS_OK,'member_moments.is_recommend'=>Common::YES])
            ->paginate($input['page_size'], ['member_moments.*','b.name as member_name','b.avatar'], 'page_index', $input['page_index']);

        $star_list = MemberStars::
        where('follow_id',$member->id)
            ->whereIn('mid',$list->keyBy('mid')->keys()->all())
            ->pluck('mid')->all();
//        var_dump($member->id);
//var_dump($star_list);die;
        //增加浏览次数
        MemberMoments::whereIn('id',$list->keyBy('id')->keys()->all())->increment('visits',1);

        if($request->ajax()){
            $html = View::make('app.artcircle.art_circle_ajax', compact('list','member','star_list'))->render();
            $this->success(['html'=>$html],'',$list->nextPageUrl());
            return response()->json($this->response);
        }else{

            $banners = DB::connection('mysql2')
                ->table('site_slide')
                ->where('multiid',3)
                ->orderBy('displayorder','desc')
                ->get();

            $no_read_msg_count = Msgs::where(['to_mid'=>$member->id,'from_mid'=>1,'read_status'=>Common::NO])->count();
            return view('app.artcircle.recommend')->with(compact('banners','list','member','star_list','no_read_msg_count'));
        }
    }

    public function index(Request $request){

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $member = $this->getMember();
        $mid_list = MemberStars::where(['follow_id'=>$member->id])->pluck('mid')->all();

        $list = MemberMoments::
        join('members as b','member_moments.mid','=','b.id')
            ->where(['b.status'=>Common::STATUS_OK])
            ->whereIn('b.id',$mid_list)
            ->paginate($input['page_size'], ['member_moments.*','b.name as member_name','b.avatar'], 'page_index', $input['page_index']);

        //增加浏览次数
        MemberMoments::whereIn('id',$list->keyBy('id')->keys()->all())->increment('visits',1);

        if($request->ajax()){
            $html = View::make('app.artcircle.art_circle_ajax', compact('list','member','is_mf'))
                ->render();
            $this->success(['html'=>$html],'',$list->nextPageUrl());
            return response()->json($this->response);
        }else{

            return view('app.artcircle.index')->with(compact('list','member','is_mf'));
        }
    }

    public function add(){

        return view('app.artcircle.add');
    }

    public function save(Request $request){


        //验证数据
        $validator = Validator::make($request->all(), [
            'art_circle_pics'      => 'required|array',
            'art_circle_desc'     => 'max:300',
            'art_circle_tags'     => 'max:100',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{

            $updates = new MemberMoments();
            $updates->mid = $this->getMember()->id;



            $updates->desc = $request->input('art_circle_desc');
            $updates->tags = $request->input('art_circle_tags');
            $array_pics = array_values($request->art_circle_pics);

            foreach ($array_pics as $key=>$pic){
                $field = 'img'.($key+1);
                $updates->$field = $pic;
                if($key == 8){
                    break;
                }
            }

            if($updates->save()){
                $this->success([],__('cateyeart.save_success'),route('art_circle'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }

    /**
     * @param $mu_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveStar($mu_id){

        $mu_id = intval($mu_id);

        $is_stared = MemberMomentsStars::where(['mu_id'=>$mu_id,'mid'=>$this->getMember()->id])->pluck('id');
        if($is_stared->isEmpty()){
            $star = new MemberMomentsStars();
            $star->mu_id = $mu_id;
            $star->mid = $this->getMember()->id;

            if($star->save()){
                $this->success(['star'=>true,'mid'=>$this->getMember()->id],'');
            }else{
                $this->error('点赞失败,请重新再试或联系客服!');
            }
        }else{
            if(MemberMomentsStars::where(['mu_id'=>$mu_id,'mid'=>$this->getMember()->id])->delete()){
                $this->success(['star'=>false,'mid'=>$this->getMember()->id],'');
            }else{
                $this->error('取消点赞失败,请重新再试或联系客服!');
            }
        }



        return response()->json($this->response);
    }
}