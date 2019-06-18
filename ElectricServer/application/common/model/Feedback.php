<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 17:04
 */

namespace app\common\model;


use think\Model;

class Feedback extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["id"] = $this->getData("id");
        $userid = $this->getData("userid");
        $info["name"] = User::get($userid)->getData("name");
        $info["time"] = $this->getData("time");
        $info["content"] = $this->getData("content");
        return $info;
    }
}