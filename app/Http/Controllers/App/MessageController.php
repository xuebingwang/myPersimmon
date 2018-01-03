<?php

namespace App\Http\Controllers\App;

use App\CatEyeArt\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Models\Albums;
use Models\Categorys;
use Models\ContentPics;
use Models\Contents;
use Models\Members;
use Illuminate\Support\Facades\Validator;
use DB;
use Models\MemberStars;
use Models\MemberMoments;
use Models\MemberMomentsStars;
use Models\MemberVerify;
use Models\Msgs;
use Qiniu\Auth;


class MessageController extends MemberController
{

    public function infoList($to_mid=0){
        $to_mid = intval($to_mid);

        $to_member = new Members();
        $to_member->avatar = '/cateyeart/v2/images/t_14.jpg';
        $to_member->id = 1;
        $to_member->name = '猫眼艺术客服';

        $from_member = $this->getMember();

        if(!empty($to_mid)){

            $to_member = Members::where('id',$to_mid)->first();
        }
        $list = Msgs::
            where(['from_mid'=>$from_member->id,'to_mid'=>$to_member->id])
            ->orWhere(['to_mid'=>$from_member->id,'from_mid'=>$to_member->id])
            ->get();

        Msgs::where(['to_mid'=>$from_member->id,'from_mid'=>$to_member->id])->update(['read_status'=>Common::YES]);

        return view('app.message.info')->with(compact('to_member','from_member','list'));
    }

    public function save(Request $request){

        //验证数据
        $validator = Validator::make($request->all(), [
            'msg_content'     => 'required|max:600',
            //more...
        ]);

        if ($validator->fails()) {

            $this->error($validator->errors()->all());
        }else{


            $item = new Msgs();
            $item->from_mid = $this->getMember()->id;

            $item->to_mid = $request->input('to_mid');
            $item->content = $request->input('msg_content');


            if($item->save()){
                $this->success(['content'=>ubb_replace($item->content)],'');
            }else{
                $this->error(__('cateyeart.save_failed'));
            }
        }

        return response()->json($this->response);
    }
}