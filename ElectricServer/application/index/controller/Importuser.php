<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 18:04
 */

namespace app\index\controller;


use app\common\model\User;

class Importuser extends BaseHandle
{
    function Index()
    {
        $typeid = $this->postdata->typeid;
        $zoneid = $this->postdata->zoneid;
        //性别默认男
        $gender = 1;
        //默认密码
        $password = md5("123456");
        $excel_array = $this->excalImport();
        foreach($excel_array as $k=>$v) {
            $Ruser= array("username" => $v[0]);
            $model = User::get($Ruser);
            if(is_null($model) and $v[0]) {
                $data[$k]['username'] = $v[0];
                $data[$k]['name'] = $v[1];
                $data[$k]['shopname'] = $v[2];
                $data[$k]['card'] = $v[3];
                $data[$k]['information'] = $v[4];
                $data[$k]['typeid'] = $typeid;
                $data[$k]['zoneid'] = $zoneid;
                $data[$k]['gender'] = $gender;
                $data[$k]['password'] = $password;
            }

        }
        $ret = User::insertAll($data);
        if($ret)
        {
            $ret = array(
                'errorCode'=>$this->config_error["success"],//导入成功
            );
        }
        else
        {
            $ret = array(
                'errorCode'=>$this->config_error["operationfiled"],//导入失败
            );
        }
        $this->SendMsg($ret);
    }
}