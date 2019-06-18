<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 17:46
 */

namespace app\index\controller;

use app\common\model\Shopzone;

//添加分区
class Addzone extends BaseHandle
{
    function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        $name = $this->postdata->name;
        //通过字段名查找是否存在
        $Ruser= array("name" => $name);
        $model = Shopzone::get($Ruser);
        if(!is_null($model))
        {
            //如果存在
            $ret =array(
                'errorCode'=>$this->config_error["userrepeated"]//用户重复
            );
            $this->SendMsg($ret);
        }
        //实例化Model对象
        $mode = new Shopzone();
        $mode->name=$this->postdata->name;
        $mode->typeid=$this->postdata->typeid;
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
        $this->SendMsg($ret);
    }
}