<?php

namespace App\Http\Controllers\App;

class Controller extends \App\Http\Controllers\Controller
{

    protected $response;

    protected $page_size = 10;

    /**
     * 观察者方法，操作失败时候回调
     * @param $error
     * @param $status
     */
    public function error($error,$status='1')
    {
        $this->response = ['status' => $status, 'msg' => (is_array($error) ? implode('<br>',$error) : $error)];
    }

    /**
     * 观察者方法，操作成功时候回调
     * @param $msg
     * @param $url
     * @param $data
     */
    public function success($data=[],$msg='操作成功!',$url='')
    {
        $this->response = ['status' => 0, 'url'=>$url,'data' =>$data, 'msg' => $msg];
    }
}
