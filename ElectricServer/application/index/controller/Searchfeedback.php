<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 21:46
 */

namespace app\index\controller;


use app\common\model\Feedback;

class Searchfeedback extends BaseHandle
{
    function Index()
    {

        $page = $this->postdata->page;
        //分页查询所有model对象
        $models =Feedback::order('id desc');
        //调用父类方法
        $this->paginate($models,$page);
    }

}