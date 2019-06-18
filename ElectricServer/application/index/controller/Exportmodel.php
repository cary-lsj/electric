<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 16:25
 */

namespace app\index\controller;


use think\Request;

class Exportmodel extends BaseHandle
{
    function Index()
    {
//        $type =1;
        $type = Request::instance()->get("type");
//        die($type);
        $ExportModelType =$this->config_data["ExportModelType"];
        switch ($type)
        {
            case $ExportModelType["shopType"]:
                $this->shopType();
                break;
            case $ExportModelType["shopZone"]:
                $this->shopZone();
                break;
            case $ExportModelType["user"]:
                $this->user();
                break;
            default:
                break;
        }
    }
    //导出业种模板
    function shopType()
    {
        $name='业种模板';
        $header=['业种名称'];
        $this->excelExport($name,$header);
    }
    //导出业种分区模板
    function shopZone()
    {
        $name='分区模板';
        $header=['分区名称'];
        $this->excelExport($name,$header);
    }

    //导出用户模板
    function user()
    {
        $name='专柜模板';
        $header=[
            '用户账号',
            '姓名',
            '专柜名称',
            '身份证',
            '联系方式',
        ];
        $this->excelExport($name,$header);
    }

}