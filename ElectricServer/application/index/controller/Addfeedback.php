<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 17:46
 */

namespace app\index\controller;

use app\common\model\Feedback;

//添加一个用户反馈
class Addfeedback extends BaseHandle
{
    function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        //实例化Model对象
        $mode = new Feedback();
        $mode->userid=$this->postdata->userid;
        $mode->time =  $this->getTime();
        $mode->content=$this->postdata->content;
        //保存该对象到数据库中
        $ret = $mode->save();
        //判断数据库是否操作成功
        if($ret !==1){
            $ret =array(
                'errorCode'=>$this->config_error["usererror"] //未添加成功
            );
        }
        else{
            $ret =array(
                'errorCode'=>$this->config_error["success"], //添加成功,
                'id'=>$mode->id,
            );
        }
        //发送消息
        $this->SendMsg($ret);
    }

}