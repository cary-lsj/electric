<?php

namespace app\index\controller;
use app\common\model\Shop;
use app\common\model\User;

//添加专柜负责人
class Adduser extends BaseHandle
{

    public function Index()
    {
        //检测用户发送的消息是否为空
        $this->CheckPostEmpty();
        //账号
        $username = $this->postdata->username;
        //通过字段名查找是否存在
        $Ruser= array("username" => $username);
        $model = User::get($Ruser);
        if(!is_null($model))
        {
            //如果存在
            $ret =array(
                'errorCode'=>$this->config_error["userrepeated"]//用户重复
            );
        }else
        {
            //该账号可以用
            //实例化一个空的负责人对象
            $model=new User();
            //账号
            $model->username = $username;
            //用户密码
            $model->password = md5($this->postdata->password);
            //专柜负责人姓名
            $model->name = $this->postdata->name;
            //专柜负责人性别
            $model->gender = $this->postdata->gender;
            //专柜负责人身份证号
            $model->card = $this->postdata->card;
            //专柜负责人联系方式
            $model->information = $this->postdata->information;
            //商店名称
            $model->shopname=$this->postdata->shopname;
            //类型
            $model->typeid=$this->postdata->typeid;
            //分区
            $model->zoneid=$this->postdata->zoneid;
            $ret = $model->save();
            //判断是数据库是否操作成功
            if($ret !==1){
                $ret =array(
                    'errorCode'=>$this->config_error["usererror"] //未添加成功
                );
            }
            else{
                $id = $model->id;
                $ret =array(
                    'errorCode'=>$this->config_error["success"], //添加成功,
                    'id'=>$id
                );
            }
        }
        $this->SendMsg($ret);
    }
}