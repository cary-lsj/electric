<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13
 * Time: 19:58
 */
namespace app\common\model;
use think\Model;
class User extends Model
{
    //获取表中的数据
    function GetInfo()
    {
        $info["id"] = $this->getData("id");
        $info["username"] = $this->getData("username");
        $info["password"] = $this->getData("password");
        $info["name"] = $this->getData("name");
        $info["gender"] = $this->getData("gender");
        $info["card"] = $this->getData("card");
        $info["information"] = $this->getData("information");
        $info["shopname"]=$this->getData("shopname");
        $info["balance"] = $this->getData("balance");
        $info["used"] = $this->getData("used");
        $info["recharge"] = $this->getData("recharge");
        $info["name"] = $this->getData("name");
        //根据业种id查询业种的名字
        $typeid = $this->getData("typeid");
        $info["typeid"] = Shoptype::get($typeid)->getData("name");
        //给句分区的id查询分区的名字
        $zoneid = $this->getData("zoneid");
        $info["zoneid"] = Shopzone::get($zoneid)->getData("name");
        return $info;
    }
}