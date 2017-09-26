<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Contents extends Works
{


    public function pics()
    {
        return $this->hasMany('Models\ContentPics','cid');
    }

    public function getLikes($page_size=null,$page_index=null)
    {

        $model = ContentLikes::join('members as m','m.id','=','content_likes.mid')
            ->select('content_likes.*','m.avatar','m.name','m.is_verfiy')
            ->where('content_likes.cid',$this->id);
        if(!empty($page_size) && !empty($page_index)){

            return $model->paginate($page_size, ['*'], 'page_index', $page_index);
        }else{
            return $model->get();
        }
    }

    public function getComments($page_size=5,$page_index=1){

        return ContentComments::
        join('members as m','m.id','=','content_comments.mid')
            ->select('content_comments.*','m.avatar','m.name','m.is_verfiy','m.city_id','m.domain')
            ->where('content_comments.cid',$this->id)
            ->orderBy('created_at','desc')
            ->paginate($page_size, ['*'], 'page_index', $page_index);
    }
}
