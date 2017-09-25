<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Models\Albums;
use Models\ContentPics;
use Models\Contents;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberMoments;
use Models\MemberMomentsStars;
use Models\MemberVerify;
use Models\Works;
use Qiniu\Auth;


class ContentController extends MemberController
{

    public function showForm(){

        $member = $this->getMember();
        $content = new Contents();
        return view('app/content/form')->with(compact('content','member'));
    }

    public function save(Request $request){


        //验证数据
        $validator = Validator::make($request->all(), [
            'content_pics'      => 'required|array',
            'title'     => 'required|max:128',
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

            $item->title = $request->input('title');
            $item->desc = $request->input('desc');

            DB::beginTransaction();

            if($item->save()){

                $f = true;
                if(!empty($id)){
                    $f = ContentPics::where('work_id',$item->id)->delete();
                }

                $item_pics = [];
                foreach ($request->input('content_pics') as $key=>$pic){
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