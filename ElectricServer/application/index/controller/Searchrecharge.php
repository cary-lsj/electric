<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 21:18
 */

namespace app\index\controller;


use app\common\model\Recharge;

class Searchrecharge extends BaseHandle
{
    function Index()
    {
        //用户id
        $id = $this->postdata->userid;
        //需要查看的页码
        $page = $this->postdata->page;
        //分页查询所有model对象
        $models = Recharge::where('userid',$id);
        //调用父类方法
        $this->paginate($models,$page);
    }
}