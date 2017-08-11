<?php

namespace App\Http\Controllers\App;


use App\CatEyeArt\Common;
use Illuminate\Support\Facades\Session;
use Models\FrontCovers;
use Models\Links;
use Models\Members;
use Models\Works;
use Persimmon\Services\SiteMap;
use Persimmon\Services\RssFeed;
use Models\Categorys;
use Models\Posts;
use Models\Tags;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\View;

class HomeController extends MemberController
{

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

        if($request->ajax()){
            $html = View::make('app.work.home_ajax', compact('comments'))->render();

            $this->success(['html'=>$html],'',$works->nextPageUrl());
            return response()->json($this->response);
        }


        $front_covers = DB::table('front_covers as a')
            ->join('works as w','a.work_id','=','w.id')
            ->join('members as m','w.mid','=','m.id')
            ->select('a.*','w.name as work_name','w.pic as work_pic','m.name as author')
            ->where([
                ['a.publish_time','<=',NOW],
                ['a.publish_end','>=',NOW],
                ['w.status','=',Common::STATUS_OK]
            ])
            ->get();

//        $front_covers->keyBy('work_id');


        return view('app.home')->with([
            'front_cover'=>$front_covers[mt_rand(0,sizeof($front_covers)-1)],
            'works'=>$works
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $posts = Posts::orderBy('id', 'desc')->paginate(15);

        return view('app.home')->with(compact('posts'));
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