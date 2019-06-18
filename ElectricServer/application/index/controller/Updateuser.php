<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 20:16
 */

namespace app\index\controller;


use app\common\model\User;

class Updateuser extends BaseHandle
{
    function Index()
    {
        //负责人的id
        $id = $this->postdata->userid;
        //通过id获取某个用户对象
        $model =User::get($id);
        //性别
        $gender = $this->postdata->gender;
        if(!empty($gender))
        {
            $model->gender = $gender ;
        }
        //身份证
        $card = $this->postdata->card;
        if(!empty($card))
        {
            $model->card = $card ;
        }
        //联系方式
        $information = $this->postdata->information;
        if(!empty($information))
        {
            $model->information = $information ;
        }
        //保存数据到数据库
        $res = $model->save();
        if(!$res)
        {
            $msg = array(
                'errorCode'=>$this->config_error["operationfiled"],//操作失败
            );
            $this->sendMsg($msg);
        }
        $msg = array(
            'errorCode'=>$this->config_error["success"],//操作成功
        );
        $this->sendMsg($msg);
    }
}