<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 14:18
 */

namespace app\common\model;


use think\Model;

class Electricity extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["prize"] = $this->getData("prize");
        $info["type"] = $this->getData("type");
        return $info;
    }
}