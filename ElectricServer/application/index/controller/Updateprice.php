<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 17:28
 */

namespace app\index\controller;


use app\common\model\Electricity;

class Updateprice extends BaseHandle
{

    function Index()
    {
        //获取价格
        $price = $this->postdata->price;
        $model = Electricity::get("1");
        //更新单价
        $model->price = $price;
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