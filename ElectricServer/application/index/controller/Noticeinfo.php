<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 18:13
 */

namespace app\index\controller;


use app\common\model\Notice;

class Noticeinfo extends BaseHandle
{
    function Index()
    {
        //声明一个数组 存所有班级的信息
        $AllInfo= array();
        //实例化寝室表
        $model = new Notice();
        //查询所有model对象
        $model = $model->select();
        //遍历寝室对象
        foreach ( $model as $k=>$v )
        {
            //获取当前寝室的所有信息
            $info=$v->GetInfo();
            //讲当前寝室信息存入   存所有寝室的信息  数组里面
            array_push($AllInfo,$info);
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