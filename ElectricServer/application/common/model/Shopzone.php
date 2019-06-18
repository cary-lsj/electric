<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 17:11
 */

namespace app\common\model;


use think\Model;

class Shopzone extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["id"] = $this->getData("id");
        $info["name"] = $this->getData("name");
        $typeid = $this->getData("typeid");
        $info["typeid"] = Shoptype::get($typeid)->getData("name");
        return $info;
    }
}