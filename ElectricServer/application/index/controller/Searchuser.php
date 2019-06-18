<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 15:30
 */

namespace app\index\controller;


use app\common\model\User;

class Searchuser extends BaseHandle
{
    function Index()
    {
        //负责人的账号
        $username = $this->postdata->username;
//        $username ="";
        //业种id
        $typeid = $this->postdata->typeid;
//        $typeid="";
        //分区id
        $zoneid = $this->postdata->zoneid;
//        $zoneid="";
        //where 联合  模糊查询
        $list =  User::where([
            'username'  =>  ['like',"%$username%"],
            'typeid' => ['like',"%$typeid%"],
            'zoneid' => ['like',"%$zoneid%"]
        ]);
        //当前页面
        $page = $this->postdata->page;
//        $page = 1;
        //调用父类的分页方法
        $this->paginate($list,$page);

    }
}