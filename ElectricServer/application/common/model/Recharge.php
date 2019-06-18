<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 14:19
 */

namespace app\common\model;


use think\Config;
use think\Model;

class Recharge extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $id = $this->getData("userid");
        $info["name"] = User::get($id)->getData("name");
        $info["time"] = $this->getData("time");
        $sourcetype = $this->getData("source");
        //给与来源的类型去配置信息里读相应的来源
        $info["source"] = Config::get("config_data")["source"][$sourcetype];
        $info["userid"] = $this->getData("userid");
        $info["money"] = $this->getData("money");
        return $info;
    }
}