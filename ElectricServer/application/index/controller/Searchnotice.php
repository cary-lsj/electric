<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 9:49
 */

namespace app\index\controller;


use app\common\model\Notice;

//查询通知
class Searchnotice extends BaseHandle
{
    function Index()
    {
        //用户id
        $page = $this->postdata->page;
//        $page= 1;
        //分页查询所有model对象
        $models =Notice::order('id desc');
        //调用父类方法
        $this->paginate($models,$page,1);
    }
}