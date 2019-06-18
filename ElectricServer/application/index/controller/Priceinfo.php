<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 16:58
 */

namespace app\index\controller;


use app\common\model\Electricity;

class Priceinfo extends BaseHandle
{
    function Index()
    {
        $price = $this->GetPrice();
        //组织返回前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'price' => $price,
        );
        //发送数据
        $this->SendMsg($msg);
    }
}