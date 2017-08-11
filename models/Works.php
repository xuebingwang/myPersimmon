<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 10:53
 */

namespace Models;


use Illuminate\Database\Eloquent\Model;

class Works extends Model
{

    public function pics()
    {
        return $this->hasMany('Models\WorkPics','work_id');
    }

    public function getLikes($page_size=null,$page_index=null)
    {

        $model = WorkLikes::join('members as m','m.id','=','work_likes.mid')
            ->select('work_likes.*','m.avatar','m.name','m.is_verfiy')
            ->where('work_likes.work_id',$this->id);
        if(!empty($page_size) && !empty($page_index)){

            return $model->paginate($page_size, ['*'], 'page_index', $page_index);
        }else{
            return $model->get();
        }
    }

    public function visit(){

        return $this->where('id',$this->id)->increment('visits',1);
    }

    public function getComments($page_size=5,$page_index=1){

        return WorkComments::
            join('members as m','m.id','=','work_comments.mid')
            ->select('work_comments.*','m.avatar','m.name','m.is_verfiy','m.city_id','m.domain')
            ->where('work_comments.work_id',$this->id)
            ->orderBy('created_at','desc')
            ->paginate($page_size, ['*'], 'page_index', $page_index);
    }
}