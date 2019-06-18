<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 17:10
 */

namespace app\common\model;


use think\Model;

class Shoptype extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["id"] = $this->getData("id");
        $info["name"] = $this->getData("name");
        return $info;
    }
}