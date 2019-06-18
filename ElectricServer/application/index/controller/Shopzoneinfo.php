<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 18:16
 */

namespace app\index\controller;


use app\common\model\Shopzone;

class Shopzoneinfo extends BaseHandle
{
    function Index()
    {
        //业种id
        $typeid = $this->postdata->id;
        //声明一个数组，所有分区信息
        $AllInfo= array();
        //实例化分区表
        $model = new Shopzone();
        $model = $model->select();
        //遍历分区对象
        foreach ( $model as $k=>$v )
        {
            //删选是否是属于该种类的
            if($v->getData("typeid")==$typeid)
            {
                //获取当前分区的所有信息
                $info=$v->GetInfo();
                //讲当前分区信息存入   存所有分区的信息  数组里面
                array_push($AllInfo,$info);
            }
        }
        //组织返回前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'allinfo' => $AllInfo,
        );
        //发送数据
        $this->SendMsg($msg);
    }
}