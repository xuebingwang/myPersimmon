<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Models\Albums;
use Models\Categorys;
use Models\ContentComments;
use Models\ContentLikes;
use Models\ContentPics;
use Models\Contents;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberMoments;
use Models\MemberMomentsStars;
use Models\MemberVerify;
use Qiniu\Auth;


class ContentController extends MemberController
{

    /**
     * @param Request $request
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$cid){

        $cid = intval($cid);
        $item = Contents::find($cid);
        if($item->mid != $this->getMember()->id){
            $this->error('该作品不是您的!');
        }
        $item->status = Common::STATUS_DEL;

        if($item->save()){

            $this->success([],__('cateyeart.delete_success'),'/'.$this->getMember()->domain);
        }else{
            $this->error(__('cateyeart.delete_failed'));
        }

        return response()->json($this->response);
    }
    /**
     * @param Request $request
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments(Request $request,$cid){
        $cid = intval($cid);

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $content = new Contents();
        $content->id = $cid;
        $comments = $content->getComments($input['page_size'],$input['page_index']);
        $me = $this->getMember();
        if($request->ajax()){
            $html = View::make('app.work.comments_ajax', compact('comments','me'))->render();
            $this->success(['html'=>$html],'',$comments->nextPageUrl());
            return response()->json($this->response);
        }else{

            return view('app.work.comments')->with(compact('comments','cid','me'));
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request){
        //验证数据
        $validator = Validator::make($request->all(), [
            'cid'     => 'required',
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
                $comments = new ContentComments();
                $comments->cid = intval($request->input('cid'));
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
     * @param $cid
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveLike($cid){

        $cid = intval($cid);


        $is_stared = ContentLikes::where(['mid'=>$this->getMember()->id,'cid'=>$cid])->pluck('id');
        if($is_stared->isEmpty()){
            $like = new ContentLikes();
            $like->mid = $this->getMember()->id;
            $like->cid = $cid;

            if($like->save()){
                $this->success(['is_liked'=>$is_stared->isEmpty()],'');
            }else{
                $this->error('点赞失败,请重新再试或联系客服!');
            }
        }else{
            if(ContentLikes::where(['mid'=>$this->getMember()->id,'cid'=>$cid])->delete()){
                $this->success(['is_liked'=>$is_stared->isEmpty()],'');
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
        $id = intval($id);

        $item = Contents::
        join('members as m','contents.mid','=','m.id')
            ->where(['contents.id'=>$id,'m.status'=>Common::STATUS_OK])
            ->select('contents.*','m.name as member_name','m.avatar','m.is_verfiy')
            ->first();

        if(empty($item)){

            return redirect('no_found')->with(['class'=>'Text2']);
        }
        $item->visit();

        $item->likes = $item->getLikes();

        $is_followed = null;

        $me = $this->getMember();
        if(!empty($me) && $me->id != $item->mid){

            $is_followed = MemberStars::where(['mid'=>$item->mid,'follow_id'=>$me->id])->first();
        }

        return view('app.content.info')->with(compact('item','is_followed','me'));
    }

    /**
     * @param Request $request
     * @param $cate_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showList(Request $request,$cate_id){

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : $this->page_size;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $member = $this->getMember();
        $list = Contents::
        join('members as b','contents.mid','=','b.id')
            ->where(['b.status'=>Common::STATUS_OK,'contents.status'=>Common::STATUS_OK,'contents.category_id'=>$cate_id])
            ->orderBy('contents.created_at','desc')
            ->paginate($input['page_size'], ['contents.*','b.name as member_name'], 'page_index', $input['page_index']);

        //增加浏览次数
        Contents::whereIn('id',$list->keyBy('id')->keys()->all())->increment('visits',1);

        if($request->ajax()){
            $html = View::make('app.content.list_ajax', compact('list','member'))->render();
            $this->success(['html'=>$html],'',$list->nextPageUrl());
            return response()->json($this->response);
        }else{

            $category = Categorys::where('id',$cate_id)->first();

            return view('app.content.list')->with(compact('list','member','category'));
        }
    }
    public function showForm($id=null){

        $categorys = Categorys::getListByPid(59);

        $member = $this->getMember();

        if(empty($id)){
            $content = new Contents();
        }else{
            $content = Contents::find($id);
            $work = Works::find($id);
            if(empty($work) || $work->mid != $this->getMember()->id || $work->status == Common::STATUS_DEL){
                $work = new Works();
            }
        }

        return view('app/content/form')->with(compact('content','member','categorys'));
    }

    public function save(Request $request){


        //验证数据
        $validator = Validator::make($request->all(), [
            'desc'      => 'required',
            'title'     => 'required|max:128',
            'category_id'=>'required'
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{


            $id = intval($request->input('content_id'));

            if (!empty($id)){
                $item = Contents::where(['id'=>$id,'mid'=>$this->getMember()->id])->first();
                if(empty($item)){
                    $this->error('该文章不是您的!');
                }
            }else{
                $item = new Contents();
                $item->mid = $this->getMember()->id;
            }

            preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$item->desc,$matches);

            $tmp_pics=array_unique($matches[2]);//去除数组中重复的值

            $item->title = $request->input('title');
            $item->category_id = $request->input('category_id');
            if(!empty($tmp_pics)){
                $item->pic = $tmp_pics[0];
            }
            $item->desc = $request->input('desc');

            DB::beginTransaction();

            if($item->save()){



                $f = true;
                if(!empty($id)){
                    $f = ContentPics::where('cid',$item->id)->delete();
                }

                $item_pics = [];
                foreach ($tmp_pics as $key=>$pic){
                    $item_pics[] = [
                        'cid'=>$item->id,
                        'url'=>$pic,
                        'sort'=>$key,
                        'created_at'=>NOW,
                        'updated_at'=>NOW,
                    ];
                }

                if($f && ContentPics::insert($item_pics)){
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
}