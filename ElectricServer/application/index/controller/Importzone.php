<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 20:30
 */

namespace app\index\controller;


use app\common\model\Shopzone;

class Importzone extends BaseHandle
{
    function Index()
    {
        $typeid = $this->postdata->typeid;
        $excel_array = $this->excalImport();
        foreach($excel_array as $k=>$v) {
            $Ruser= array("name" => $v[0]);
            $model = Shopzone::get($Ruser);
            if(is_null($model) and $v[0])
            {
                $data[$k]['name'] = $v[0];
                $data[$k]['typeid'] = $typeid;
            }
        }
        $ret = Shopzone::insertAll($data);
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