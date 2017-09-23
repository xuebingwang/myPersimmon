<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 10:53
 */

namespace Models;


use Illuminate\Database\Eloquent\Model;

class MemberMoments extends Model
{

    protected $stars;

    public function getStars()
    {
        if(empty($this->stars)){

            $this->stars = MemberMomentsStars::join('members as m','m.id','=','member_moments_stars.mid')
                ->select('member_moments_stars.*','m.avatar','m.name','m.is_verfiy')
                ->where('member_moments_stars.mu_id',$this->id)->get();

        }

        return $this->stars;
    }
}