<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Models\Albums;
use Models\Contents;
use Models\MemberMoments;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberVerify;
use Models\Works;
use Qiniu\Auth;
use Illuminate\Support\Facades\View;


class MemberInfoController extends MemberController
{

    public function contents(Request $request)
    {

//        $input = $request->all();
//        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
//        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $member = $this->getMember();
        $list = Contents::
        where(['contents.status' => Common::STATUS_OK, 'contents.mid' => $member->id])
            ->orderBy('contents.created_at', 'desc')
            ->select('contents.*')
            ->get();
//            ->paginate($input['page_size'], ['contents.*'], 'page_index', $input['page_index']);

        //增加浏览次数
        Contents::whereIn('id', $list->keyBy('id')->keys()->all())->increment('visits', 1);

//        if ($request->ajax()) {
//            $html = View::make('app.content.list_ajax', compact('list', 'member'))->render();
//            $this->success(['html' => $html], '', $list->nextPageUrl());
//            return response()->json($this->response);
//        } else {

            return view('app.member.content_list')->with(compact('list', 'member'));
//        }
    }

    public function starMemberWorks(Request $request){

        $input = $request->all();
        $input['page_size'] = 10;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $mid_list = MemberStars::where(['follow_id'=>$this->getMember()->id])->pluck('mid')->all();
        $works = Works::join('albums as c','works.album_id','=','c.id')
            ->join('members as m','works.mid','=','m.id')
            ->where(['c.is_public'=>Common::YES,'works.status'=>Common::STATUS_OK])
            ->whereIn('works.mid',$mid_list)
            ->select(
                'works.*',
                'm.name as author',
                'm.avatar as member_avatar',
                'm.domain as member_domain',
                'm.last_login as member_last_login',
                'm.city_id as member_city_id'
            )

            ->orderBy('works.updated_at','desc')
            ->paginate($input['page_size'], ['*'], '', $input['page_index']);

//        if($request->ajax()){
//            $html = View::make('app.work.home_ajax', compact('works'))->render();
//
//            $this->success(['html'=>$html],'',$works->nextPageUrl());
//            return response()->json($this->response);
//        }

        return view('app.work.star_list')->with([
            'works'=>$works
        ]);

    }
    public function saveVerifyApply(Request $request){
        $work_count = Works::where('mid',$this->getMember()->id)->count();

        if($work_count < 10){

            $this->error('您的作品数量不足10件!');
            return response()->json($this->response);
        }

        //验证数据
        $validator = Validator::make($request->all(), [
            'real_name'         => 'required|max:30',
            'paper_num'         => 'required|digits:18',
            'school_name'       => 'required|max:50',
            'in_school_year'    => 'required|digits:4',
            'out_school_year'   => 'required|digits:4',
            'id_pic'            => 'required',
            'head_pic'          => 'required',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{

            $member_verify = MemberVerify::where('mid',$this->getMember()->id)->first();

            if(empty($member_verify)){
                $member_verify = new MemberVerify();
            }
            $member_verify->mid = $this->getMember()->id;
            $member_verify->real_name = $request->input('real_name');
            $member_verify->paper_num = $request->input('paper_num');
            $member_verify->school_name = $request->input('school_name');
            $member_verify->in_school_year = $request->input('in_school_year');
            $member_verify->out_school_year = $request->input('out_school_year');
            $member_verify->id_pic = $request->input('id_pic');
            $member_verify->head_pic = $request->input('head_pic');


            if($member_verify->save()){
                $this->success([],__('cateyeart.save_success'),route('member_index'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }

    public function verifyApply(){

        $work_count = Works::where('mid',$this->getMember()->id)->count();

        if($work_count < 10){

            return redirect('no_found')->with(['class'=>'Text1','msg'=>'您的作品数量不足10件!']);
        }


        $member_verify = MemberVerify::where('mid',$this->getMember()->id)->first();
        if(empty($member_verify)){
            $member_verify = new MemberVerify();
        }

        return view('app.member.verify_apply')->with(compact('member_verify'));
    }

    public function verify(){

        $work_count = Works::where('mid',$this->getMember()->id)->count();
        return view('app.member.verify')->with(compact('work_count'));
    }

    public function works(Request $request,$mid){

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $me = $this->getMember();
        $works = Works::
        join('albums as c','works.album_id','=','c.id')
            ->where(['works.mid'=>$mid,'works.status'=>Common::STATUS_OK])
            ->where(function ($query) use($mid,$me){
                if($mid != $me->id){
                    $query->where('c.is_public',Common::YES);
                }
            })
            ->select('works.*')
            ->orderBy('updated_at','desc')
            ->paginate($input['page_size'], ['*'], '', $input['page_index']);

        return view('app.member.works')->with(compact('works'));

    }

    public function moments(Request $request,$mid){
        $mid = intval($mid);

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $mid_list = MemberStars::where(['follow_id'=>$mid])->pluck('mid')->all();

        $mid_list[] = $mid;

        $list = MemberMoments::
        join('members as b','member_moments.mid','=','b.id')
            ->whereIn('member_moments.mid',$mid_list)
            ->orderBy('member_moments.created_at','desc')
            ->paginate($input['page_size'], ['member_moments.*','b.name as member_name','b.avatar'], 'page_index', $input['page_index']);


        return view('app.member.moments')->with(compact('list'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQiniuUploadToken(){

        $config = config('filesystems.disks.qiniu');
        $auth = new Auth($config['access_key'], $config['secret_key']);

        return response()->json(['upload_token'=>$auth->uploadToken($config['bucket'])]);
    }

    /**
     * @param $mid
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveStar($mid){

        $mid = intval($mid);
        if($mid == $this->getMember()->id){
            $this->error('不能关注自己!');
        }else{
            $is_stared = MemberStars::where(['mid'=>$mid,'follow_id'=>$this->getMember()->id])->pluck('id');
            if($is_stared->isEmpty()){
                $star = new MemberStars();
                $star->mid = $mid;
                $star->follow_id = $this->getMember()->id;

                if($star->save()){
                    $this->success(['is_stared'=>$is_stared->isEmpty()],'');
                }else{
                    $this->error('关注失败,请重新再试或联系客服!');
                }
            }else{
                if(MemberStars::where(['mid'=>$mid,'follow_id'=>$this->getMember()->id])->delete()){
                    $this->success(['is_stared'=>$is_stared->isEmpty()],'');
                }else{
                    $this->error('取消关注失败,请重新再试或联系客服!');
                }
            }
        }



        return response()->json($this->response);
    }

    /**
     * @return $this
     */
    public function home(Request $request,$domain_mid){


        $member = Members::where('id',$domain_mid)
            ->orWhere('domain',$domain_mid)
            ->first();

        if(empty($member)){

            return redirect('no_found')->with(['class'=>'Text3']);
        }

        $follow_count = MemberStars::where('mid',$member->id)->count();
        $work_count = Works::where('mid',$member->id)->count();

        $is_followed = null;
        $me = $this->getMember();

        if(!empty($me) && $me->id != $member->id){

            $is_followed = MemberStars::where(['mid'=>$member->id,'follow_id'=>$me->id])->first();
        }

        $album_list = Albums::where('mid',$member->id)->where(function($query) use($member,$me){
            if($me->id != $member->id){
                $query->where('is_public',Common::YES);
            }
        })->get();

        foreach ($album_list as &$album){
            $album->count = Works::where('album_id',$album->id)->count();
            $work = Works::where('album_id',$album->id)->select('pic')->first();
            $album->pic = empty($work) ? '' : $work->pic;
        }

        return view('app.member.home')->with(compact('member','work_count','album_list','me','follow_count','is_followed'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetting(){


        return view('app.member.setting');
    }

    /**
     * @return $this
     */
    public function showInfoForm(){

        return view('app.member.info')->with(['member'=>$this->getMember()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPasswordForm(){

        return view('app.member.password');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPrivacyForm(){

        return view('app.member.privacy')->with(['member'=>$this->getMember()]);
    }

    public function savePic(Request $request){

        $pic_url = $request->input('pic_url','');
        if(empty($pic_url)){
            $this->error('请上传图片!');
        }else{

            $pic_type = $request->input('pic_type');
            $member = $this->getMember();
            if($pic_type == 'avatar'){

                $member->avatar = $pic_url;
            }else{
                $member->home_back = $pic_url;
            }

            if($member->save()){
                session(['member_auth',$member]);
                $this->success(['pic_url'=>image_view2($pic_url,410,235),'pic_type'=>$pic_type],__('cateyeart.save_success'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveInfo(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:20',
            'domain'     => [
                'required',
                'min:4',
                'max:18',
                'alpha_num',
                Rule::unique('members')->ignore($this->getMember()->id),
            ],
            'sex' => [
                'required',
                Rule::in(array_keys(Members::$sex_array))
            ],
            'birthday' => 'required|date',
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'area_id' => 'required|numeric',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{


            $member = $this->getMember();
            $member->name = $request->input('name');
            $member->domain = $request->input('domain');
            $member->sex = $request->input('sex');
            $member->birthday = $request->input('birthday');
            $member->province_id = $request->input('province_id');
            $member->city_id = $request->input('city_id');
            $member->area_id = $request->input('area_id');

            if($member->save()){
                session(['member_auth',$member]);
                $this->success([],__('cateyeart.save_success'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePassword(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'old'     => 'required|min:6|max:20',
            'new'     => 'required|min:6|max:20',
            'confirm'     => 'required|same:new',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }elseif(!Hash::check($request->input('old'),$this->getMember()->password)) {
            $this->error('旧密码不正确!');
        }else{

            $member = $this->getMember();
            $member->password = bcrypt($request->input('new'));

            if($member->save()){
                session(['member_auth',$member]);
                $this->success([],__('cateyeart.save_pwd_success'),route('member_setting'));
            }else{
                $this->error(__('cateyeart.save_pwd_failed'));
            }
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePrivacy(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'is_show_liked' => [
                Rule::in([Common::YES,Common::NO])
            ],
            'is_show_collect' => [
                Rule::in([Common::YES,Common::NO])
            ],
            //more...
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->all());
        }else{

            $member = $this->getMember();
            $member->is_show_liked = $request->input('is_show_liked','n');
            $member->is_show_collect = $request->input('is_show_collect','n');

            if($member->save()){
                session(['member_auth',$member]);
                $this->success([],__('cateyeart.save_success'),route('member_setting'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }
}