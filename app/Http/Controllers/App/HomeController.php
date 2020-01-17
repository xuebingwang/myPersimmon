<?php

namespace App\Http\Controllers\App;


use App\CatEyeArt\Common;
use Models\CatApply;
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
use Illuminate\Support\Facades\Validator;

class HomeController extends MemberController
{

    public function saveApply(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'mobile'        => 'required|max:11',
            'nickname'      => 'required|max:18',
            'category'      => 'required|max:20',
            'sex'           => 'required|max:3',
            'age'           => 'required|digits:2',
            'address'       => 'required',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{

//            $member_verify = MemberVerify::where('mid',$this->getMember()->id)->first();
//
//            if(empty($member_verify)){
//                $member_verify = new MemberVerify();
//            }
//            $member_verify->mid = $this->getMember()->id;
//            $member_verify->real_name = $request->input('real_name');
//            $member_verify->paper_num = $request->input('paper_num');
//            $member_verify->school_name = $request->input('school_name');
//            $member_verify->in_school_year = $request->input('in_school_year');
//            $member_verify->out_school_year = $request->input('out_school_year');
//            $member_verify->id_pic = $request->input('id_pic');
//            $member_verify->head_pic = $request->input('head_pic');

            $item = new CatApply();
            $item->type = $request->input('type',1);
            $item->mobile = $request->input('mobile');
            $item->nickname = $request->input('nickname');
            $item->category = $request->input('category');
            $item->sex = $request->input('sex');
            $item->age = $request->input('age');
            $item->address = $request->input('address');
            $item->create_time = time();

            if ($item->save()){
                $this->success([],__('cateyeart.save_success'));
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }

    public function memberList($cate_id=0){

        $cate_id = intval($cate_id);
        $category = Categorys::find($cate_id);

        if(empty($category)){

            return redirect('no_found')->with(['class'=>'Text1']);
        }

        $list = Members::where(['cate_id'=>$cate_id,'status'=>Common::STATUS_OK])->get();

        $me = $this->getMember();

        $gz_list = MemberStars::whereIn('mid',$list->keyBy('id')->keys()->all())->where('follow_id',$me->id)->pluck('mid')->all();

        return view('app.home.member_list')->with(compact('category','list','gz_list'));
    }

    public function search(Request $request){

        if($request->ajax()){
            $type = $request->input('type','work');
            $input = $request->all();

            $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : 10;
            $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

            switch ($type){
                case 'user':

                    $map = [
                        ['status','=',Common::STATUS_OK],
                    ];
                    $keyword = '';
                    if(isset($input['q'])){
                        $map[] = ['name','like','%'.$input['q'].'%'];
                        $keyword = $input['q'];
                    }

                    $select = ['members.*'];
                    $model = Members::where($map);
                    if(is_login()){
                        $me = $this->getMember();
                        $model->leftJoin('member_stars as s',function($query) use($me){
                            $query->on('s.mid','=','members.id')
                                ->where('s.follow_id',$me->id);
                        });
                        $select[] = 's.follow_id';
                    }
                    $results = $model->paginate($input['page_size'], $select, '', $input['page_index']);

//                    var_dump($results);die;
                    $html = View::make('app.search.user',compact('results','keyword'))->render();

                    break;
                default:

                    $map = [
                        ['w.status','=',Common::STATUS_OK],
                        ['a.is_public','=',Common::YES] ,
                    ];
                    $keyword = '';
                    if(isset($input['q'])){
                        $map[] = ['w.name','like','%'.$input['q'].'%'];
                        $keyword = $input['q'];
                    }

                    if(!empty($input['subject'])){
                        $map[] = ['w.category_id','=',$input['subject']];
                    }

                    if(!empty($input['sizes'])){
                        $sizes = explode(',',$input['sizes']);
                        if(sizeof($sizes) == 2){

                            $map[] = ['w.size_w','>=',$sizes[0]];
                            $map[] = ['w.size_w','<=',$sizes[1]];
                        }
                    }

                    if(!empty($input['years'])){
                        $map[] = ['w.times','=',$input['years']];
                    }

                    if(!empty($input['province_id'])){
                        $map[] = ['m.province_id','=',$input['province_id']];
                    }

                    $order_by = 'updated_at';
                    if(!empty($input['sort'])){
                        if($input['sort'] == 'mtime'){
                            $order_by = 'created_at';
                        }
                    }

                    $results = DB::table('works as w')
                        ->join('members as m','w.mid','=','m.id')
                        ->join('albums as a','w.album_id','=','a.id')
                        ->where($map)
                        ->select('w.*','m.name as author','m.domain','m.last_login','m.city_id')
                        ->orderBy($order_by,'DESC')
                        ->paginate($input['page_size'], ['*'], '', $input['page_index']);

                    $html = View::make('app.search.work',compact('results','keyword'))->render();

            }
            $this->success(['html'=>$html],'',$results->nextPageUrl());
            return response()->json($this->response);
        }
        return view('app.search.index')->with([
            'categorys'=>Categorys::getListByPid(5),
        ]);
    }

    public function index(Request $request){

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : 10;
        $page_index = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $show = $request->input('show');
        $vr_url = env('VR_URL');

        $client = new Client(['base_uri' => $vr_url]);
        $res = $client->request('POST', "pictures", [
            'form_params' => ['act'=>'list', 'page'=>$page_index,'tag'=>-1]
        ]);
        $data = $res->getBody();
//        $data = '[{"name":"\u5218\u56fd\u4e49VR\u6cb9\u753b\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1236\/media\/img\/53f30235fb3629db.png","view_uuid":"ff73b300c7eeb1c7","profile":"","browsing_num":"1"},{"name":"\u66fe\u68b5\u5fd7VR\u6cb9\u753b\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1236\/media\/img\/bb2755331668a4b7.png","view_uuid":"cf6f4373eaaf305c","profile":"","browsing_num":"2"},{"name":"\u5218\u6653\u521aVR\u6c34\u5f69\u753b\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1236\/media\/img\/db448294f8ae6863.png","view_uuid":"cef4a9bf801383b1","profile":"","browsing_num":"4"},{"name":"\u5434\u51a0\u4e2dVR\u6c34\u58a8\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1234\/media\/img\/9efd227c83f2dd98.png","view_uuid":"ef3b0313f259168b","profile":"","browsing_num":"4"},{"name":"\u9f50\u767d\u77f3\u6570\u5b57VR\u827a\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1235\/media\/img\/e52911ca3861de6a.jpg","view_uuid":"5aaaedbc64f19e41","profile":"","browsing_num":"37"},{"name":"\u8d75\u65e0\u6781\u7cbe\u54c1\u5217\u5c55","thumb_path":"http:\/\/vrimg.cateyeart.com\/1232\/media\/img\/611250e3d7324d29.png","view_uuid":"08145e91397bf93d","profile":"","browsing_num":"22"}]';

        $data = json_decode($data,true);
        $vr_list = $data;
//        var_dump($data);die;
//        if (is_array($data) && isset($data['list'])){
//            $vr_list = $data['list'];
//        }
        if($request->ajax()){
            $html = View::make('app.vr.home_ajax', compact('vr_list','vr_url'))->render();

            $this->success(['html'=>$html],'');
            return response()->json($this->response);
        }

        $banners = DB::connection('mysql2')
            ->table('site_slide')
            ->where('multiid',4)
            ->orderBy('displayorder','desc')
            ->get();
        return view('app.home.index')->with([
            'banners'=>$banners,
            'works'=>$vr_list,
            'vr_url'=>$vr_url,
            'show'=>$show,
        ]);

    }

    public function index3(Request $request){

        $input = $request->all();
        $input['page_size'] = isset($input['page_size']) ? intval($input['page_size']) : 10;
        $input['page_index'] = isset($input['page_index']) ? intval($input['page_index']) : 1;

        $works = Works::join('albums as c','works.album_id','=','c.id')
                        ->join('members as m','works.mid','=','m.id')
                        ->where(['c.is_public'=>Common::YES,'works.status'=>Common::STATUS_OK])
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

        $liked_list = [];
        if(is_login()){

            $liked_list = WorkLikes::
                whereIn('work_id',$works->keyBy('id')->keys()->all())
                ->where('mid',$this->getMember()->id)
                ->pluck('work_id')
                ->all();
        }

        if($request->ajax()){
            $html = View::make('app.work.home_ajax', compact('works','liked_list'))->render();

            $this->success(['html'=>$html],'',$works->nextPageUrl());
            return response()->json($this->response);
        }

        $banners = DB::connection('mysql2')
            ->table('site_slide')
            ->where('multiid',4)
            ->orderBy('displayorder','desc')
            ->get();

        return view('app.home.index')->with([
            'banners'=>$banners,
            'works'=>$works,
            'liked_list'=>$liked_list,
        ]);
    }
    /**
     * Show the application dashboard.
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {
        $posts = Posts::orderBy('id', 'desc')->paginate(15);

        return view('app.home2')->with(compact('posts'));
    }

    public function posts($flag)
    {
        $post = app(\Persimmon\Services\RedisCache::class)->cachePost($flag);

        !empty($post) ?: abort(404, '很抱歉，页面找不到了。');

        Posts::increment('views', 1);

        return view('app.post')->with(compact('post'));
    }

    /**
     * Tag page
     * @param $tag
     */
    public function tags($tag)
    {

        $tags = Tags::where('tags_name', $tag)->first();

        !empty($tags) ?: abort(404, '很抱歉，页面找不到了。');

        $posts = $tags->posts()->paginate(15);

        return view('app.home')->with(compact('posts', 'tags'));

    }

    /**
     * 分类
     * @param $flag
     * @return $this
     */
    public function category($flag)
    {
        $category = Categorys::where('category_flag', $flag)->first();

        !empty($category) ?: abort(404, '很抱歉，页面找不到了。');

        $posts = $category->posts()->paginate(15);

        return view('app.home')->with(compact('posts', 'category'));
    }

    /**
     * friends links
     * @return $this
     */
    public function friends()
    {
        $links = Links::all();

        return view('app.friends')->with(compact('links'));
    }

    /**
     * Feed 流
     * @return mixed
     */
    public function feed(RssFeed $feed)
    {
        $rss = $feed->getRSS();

        return response($rss)->header('Content-type', 'text/xml; charset=UTF-8');
    }

    /**
     * 站点地图
     * @param SiteMap $siteMap
     * @return mixed
     */
    public function siteMap(SiteMap $siteMap)
    {
        $map = $siteMap->getSiteMap();

        return response($map)->header('Content-type', 'text/xml');
    }

    /**
     * 观察者方法，操作失败时候回调
     * @param $error
     */
    public function creatorFail($error)
    {
        $this->response = ['status' => 'error', 'id' => '', 'info' => $error];
    }

    /**
     * 观察者方法，操作成功时候回调
     * @param $model
     */
    public function creatorSuccess($model)
    {
        $this->response = ['status' => 'success', 'id' => $model->id, 'info' => '评论发布成功'];
    }
}