<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 15:16
 */

namespace app\index\controller;
use app\common\model\Shoptype;

class Importtype extends BaseHandle
{

    function Index()
    {
        //读表
        $excel_array = $this->excalImport();
        //遍历表中的数据
        foreach($excel_array as $k=>$v) {
            $Ruser= array("name" => $v[0]);
            $model = Shoptype::get($Ruser);
            if(is_null($model) and $v[0] )
            {
                $data[$k]['name'] = $v[0];
            }

        }
        $ret = Shoptype::insertAll($data);
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