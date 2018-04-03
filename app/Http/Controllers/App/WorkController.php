<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Log;
use Models\Albums;
use Models\Categorys;
use Models\Members;
use Models\MemberStars;
use Models\WorkComments;
use Models\WorkLikes;
use Models\WorkPics;
use Models\Works;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class WorkController extends MemberController
{

    public function showList(Request $request){

        $input = $request->all();
        $input['page_size'] = 20;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $works = Works::join('albums as c','works.album_id','=','c.id')
            ->join('members as m','works.mid','=','m.id')
            ->where(['c.is_public'=>Common::YES,'works.status'=>Common::STATUS_OK])
            ->select(
                'works.*'
//                'm.name as author',
//                'm.avatar as member_avatar',
//                'm.domain as member_domain',
//                'm.last_login as member_last_login',
//                'm.city_id as member_city_id'
            )

            ->orderBy('works.updated_at','desc')
            ->paginate($input['page_size'], ['*'], '', $input['page_index']);

//        if($request->ajax()){
//            $html = View::make('app.work.home_ajax', compact('works'))->render();
//
//            $this->success(['html'=>$html],'',$works->nextPageUrl());
//            return response()->json($this->response);
//        }

        return view('app.work.home_list')->with([
            'works'=>$works
        ]);
    }

    /**
     * @param Request $request
     * @param $work_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments(Request $request,$work_id){
        $work_id = intval($work_id);

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $work = new Works();
        $work->id = $work_id;
        $comments = $work->getComments($input['page_size'],$input['page_index']);
        $me = $this->getMember();
        if($request->ajax()){
            $html = View::make('app.work.comments_ajax', compact('comments','me'))->render();
            $this->success(['html'=>$html],'',$comments->nextPageUrl());
            return response()->json($this->response);
        }else{

            return view('app.work.comments')->with(compact('comments','work_id','me'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'work_id'     => 'required',
            'comment'     => 'required|max:500',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{


            $content_str = strip_tags($request->input('comment'));
            $content = preg_replace("/回复@.+：/is", "", $content_str);
            if(empty($content)){

                $this->error('评论内容不能为空!');
            }else{
                $comments = new WorkComments();
                $comments->work_id = intval($request->input('work_id'));
                $comments->content = $content_str;
                $comments->mid = $this->getMember()->id;
                $comments->pid = intval($request->input('pid'));

                if($comments->save()){

                    $this->success([
                        'content'=>ubb_replace($content_str),
                        'avatar'=>image_view2($this->getMember()->avatar,60,60),
                        'domain'=>$this->getMember()->domain,
                        'member_name'=>$this->getMember()->name,
                        'member_city_id'=>$this->getMember()->city_id,
                    ],'评论成功!');
                }else{
                    $this->error('评论失败,请重新再试或联系客服!');
                }
            }


        }
        return response()->json($this->response);
    }

    /**
     * @param $album_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function listByAlbum($album_id){

        $album = Albums::find($album_id);
        if(empty($album) || ($album->is_public == Common::NO && $this->getMember()->id != $album->mid)){
            return redirect('no_found');
        }
        $works = Works::
            leftJoin('categorys as c','works.category_id','=','c.id')
            ->select('works.*','c.category_name')
            ->where(['works.album_id'=>$album_id,'works.status'=>Common::STATUS_OK])->get();

        return view('app.work.list')->with(compact('works','album'));
    }

    /**
     * @param $work_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveLike($work_id){

        $work_id = intval($work_id);


        $is_liked = WorkLikes::where(['mid'=>$this->getMember()->id,'work_id'=>$work_id])->pluck('id');
        if($is_liked->isEmpty()){
            $like = new WorkLikes();
            $like->mid = $this->getMember()->id;
            $like->work_id = $work_id;

            if($like->save()){
                $this->success(['is_liked'=>$is_liked->isEmpty()],'');
            }else{
                $this->error('点赞失败,请重新再试或联系客服!');
            }
        }else{
            if(WorkLikes::where(['mid'=>$this->getMember()->id,'work_id'=>$work_id])->delete()){
                $this->success(['is_liked'=>$is_liked->isEmpty()],'');
            }else{
                $this->error('取消点赞失败,请重新再试或联系客服!');
            }
        }

        return response()->json($this->response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function info($id){
        $work = Works::
                    join('members as m','works.mid','=','m.id')
                    ->join('categorys as c','works.category_id','=','c.id')
                    ->where(['works.id'=>$id,'works.status'=>Common::STATUS_OK])
                    ->select('works.*','m.name as member_name','m.stars','m.avatar','m.is_verfiy','c.category_name')
                    ->first();

        if(empty($work)){

            return redirect('no_found')->with(['class'=>'Text2']);
        }
        $work_num = Works::where('mid',$work->mid)->count();

        $work->visit();

        $work->likes = $work->getLikes();

        $is_followed = null;

        $me = $this->getMember();
        if(!empty($me) && $me->id != $work->mid){

            $is_followed = MemberStars::where(['mid'=>$work->mid,'follow_id'=>$me->id])->first();
        }

        return view('app.work.info')->with(compact('work','work_num','is_followed','me'));
    }

    /**
     * @param Request $request
     * @param $work_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$work_id){

        $work_id = intval($work_id);
        $work = Works::find($work_id);
        if($work->mid != $this->getMember()->id){
            $this->error('该作品不是您的!');
        }
        $work->status = Common::STATUS_DEL;

        if($work->save()){

            $this->success([],__('cateyeart.delete_success'),'/'.$this->getMember()->domain);
        }else{
            $this->error(__('cateyeart.delete_failed'));
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @param null $id
     * @return $this
     */
    public function showAlbumForm(Request $request,$id=null){

        $request->session()->keep('add_work');

        if(empty($id)){
            $album = new Albums();
        }else{
            $album = Albums::find($id);
            if(empty($album) || $album->mid != $this->getMember()->id){
                $album = new Albums();
            }
        }

        return view('app.album.form')->with(['album'=>$album]);
    }

    /**
     * @param Request $request
     * @param null $id
     * @return $this
     */
    public function showForm(Request $request,$id=null){

        $albums = Albums::where('mid',$this->getMember()->id)->get()->toArray();

        if(empty($albums)){
            $request->session()->flash('add_work',true);
            return redirect(route('member_album_add'))->withErrors('请您先创建作品集!');
        }

        if(empty($id)){
            $work = new Works();
        }else{
            $work = Works::find($id);
            if(empty($work) || $work->mid != $this->getMember()->id || $work->status == Common::STATUS_DEL){
                $work = new Works();
            }
        }

        return view('app.work.form')->with([
            'work'=>$work,
            'albums'=>$albums,
            'categorys'=>Categorys::getListByPid(5),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveWork(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'work_pics'      => 'required|array',
            'work_name'     => 'required|max:30',
            'work_category_id'     => 'required',
//            'size_h'     => 'required|integer|max:99999',
//            'size_w'     => 'required|integer|max:99999',
            'quality'     => 'max:30',
            //more...
        ]);

        $work_size = $request->input('work_size');

        $work_size = explode('x',$work_size);
        if(sizeof($work_size) != 2){

            $this->error('作品尺寸不正确,格式:宽x高');
        }elseif ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{

            foreach ($work_size as &$num){
                $num = intval($num);
            }
            $id = intval($request->input('work_id'));

            if (!empty($id)){
                $work = Works::where(['id'=>$id,'mid'=>$this->getMember()->id])->first();
                if(empty($work)){
                    $this->error('该作品集不是您的!');
                }
            }else{
                $work = new Works();
                $work->mid = $this->getMember()->id;
            }


            $work->name = $request->input('work_name');
            $work->category_id = $request->input('work_category_id');

            $work->size_w = $work_size[0];
            $work->size_h = $work_size[1];

            $work->times = $request->input('times');
            $work->quality = $request->input('quality');
            $work->album_id = $request->input('album_id');
            $work->desc = $request->input('work_desc');
            $work->tags = $request->input('work_tags');
            $work->pic = $request->input('work_pics')[0];

            DB::beginTransaction();

            if($work->save()){

                $f = true;
                if(!empty($id)){
                    $f = WorkPics::where('work_id',$work->id)->delete();
                }

                $work_pics = [];
                foreach ($request->input('work_pics') as $key=>$pic){
                    $work_pics[] = [
                        'work_id'=>$work->id,
                        'url'=>$pic,
                        'sort'=>$key,
                        'created_at'=>NOW,
                        'updated_at'=>NOW,
                    ];
                }
                if($f && WorkPics::insert($work_pics)){
                    DB::commit();
                    $this->success([],__('cateyeart.save_success'),'/'.$this->getMember()->domain);
                }else{

                    DB::rollBack();
                    $this->error(__('cateyeart.save_failed'));
                }
            }else{
                DB::rollBack();
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveAlbum(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'album_name'     => 'required|max:20',
            'is_public' => [
                Rule::in([Common::YES,Common::NO])
            ],
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{


            $id = intval($request->input('album_id'));

            if (!empty($id)){
                $album = Albums::where(['id'=>$id,'mid'=>$this->getMember()->id])->first();
                if(empty($album)){
                    $this->error('该作品集不是您的!');
                }
            }else{
                $album = new Albums();
                $album->mid = $this->getMember()->id;
            }

            $album->name = $request->input('album_name');
            $album->is_public = $request->input('is_public',Common::NO);

            if($album->save()){
                $url = ($request->session()->get('add_work') ? route('member_work_add') : '/'.$this->getMember()->domain);
                $this->success([],__('cateyeart.save_success'),$url);
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }
        return response()->json($this->response);
    }
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAlbum(Request $request,$id){

        $id = intval($id);
        $item = Albums::find($id);
        if($item->mid != $this->getMember()->id){
            $this->error('该作品集不是您的!');
        }elseif(Works::where('album_id',$id)->count() > 0){
            $this->error('该作品集下还有作品,不能删除!');
        }else{
            if(Albums::where('id',$id)->delete()){

                $this->success([],__('cateyeart.delete_success'),'/'.$this->getMember()->domain);
            }else{
                $this->error(__('cateyeart.delete_failed'));
            }
        }


        return response()->json($this->response);
    }
}