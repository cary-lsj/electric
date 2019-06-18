<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 17:07
 */

namespace app\common\model;


use think\Model;

class Notice extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["id"] = $this->getData("id");
        $info["time"] = $this->getData("time");
        $info["content"] = $this->getData("content");
        return $info;
    }
}