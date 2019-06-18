<?php

namespace app\index\controller;


use app\common\model\Electricity;
use think\Config;
use think\Controller;
use think\Request;

//消息处理基类
class BaseHandle extends Controller
{
    protected $config_error;
    protected $config_data;
    protected $postdata;
    //构造函数
    public function __construct()
    {
        //错误码配置
        $this->config_error = Config::get("config_error");
        //配置信息
        $this->config_data = Config::get("config_data");
        //前端发送的数据
        $this->postdata =json_decode(json_encode( Request::instance()->post()));
//        $this->postdata=json_decode(file_get_contents('php://input'));
//        if(!$this->postdata)
//        {
//            $this-> Sendlog($this->postdata);
//        }
        //引入PHPExcel
        import('phpexcel.PHPExcel', EXTEND_PATH);
    }
    //入口
    public function Index()
    {

    }
    //发送消息
    protected function SendMsg($msg=null)
    {
        echo  json_encode($msg);
        die();
    }
    //发送日志
    protected function Sendlog($msg=null)
    {
        $errorlog =array(
            'nErrorCode'=>$this->config_error["error"],
                'errorlog'=>$msg
        );
        $this->SendMsg($errorlog);
    }
    //检测用户发送的消息是否为空
    protected function CheckPostEmpty()
    {
        if(!$this->postdata)
        {
            $this-> Sendlog($this->postdata);
        }
    }
    //获取当前时间
    protected function getTime()
    {
        return date('y-m-d h:i:s',time());
    }
    //获取价格
    protected function GetPrice()
    {
        //从价格表里读数据
        $price = Electricity::get("1")->getData("price");
        return $price + 0;
    }
    //分页
    /**

     * 分页

     * @param * $models 模型

     * @param int $page 当前页

     * @param int $listRows 一页多少条数据

     * @author static6  */
    protected function paginate($models,$page,$listRows = 5)
    {
//        $listRows = 5;//一页多少数据

        $list = $models->paginate($listRows,false,['query'=>$page]);
        //所有的对象
        $AllInfo = [];
        //遍历所有的对象
        foreach ( $list->items() as $k=>$v )
        {
            //获取当前对象的所有信息
            $info=$v->GetInfo();
            //将数据存入数组中
            array_push($AllInfo,$info);
        }
        //最后一页的页码  也是一共多少页
        $lastpage = $list->lastPage();
        //数据的总条数
        $total = $list->total();
        //当下页码
        $page = $list->currentPage();
        //组织返回前端的数据
        $msg=array(
            'errorCode' => $this->config_error["success"],
            'allinfo' => $AllInfo,
            'pageinfo'=>[
                'listrows' => $listRows,
                'lastpage' => $lastpage,
                'page' => $page,
                'total' => $total
            ]
        );
        //发送数据
        $this->SendMsg($msg);
    }
    //保存前端发过来的Excal
    protected function excalImport()
    {
        $objPHPExcel = new \PHPExcel();
        //获取表单上传文件
        $file = request()->file('excel');
        //将文件存入指定目录
        $info = $file->validate(['size'=>15678,'ext'=>'xlsx,xls,csv'])->move(ROOT_PATH . 'public' . DS . 'excel');
        if($info){
            $exclePath = $info->getSaveName();  //获取文件名
            return $this->Import($exclePath);
        }else{
            // 上传失败获取错误信息
            $msg = array(
                'nErrorCode'=>$this->config_error["fileerror"]
            );
            $this->SendMsg($msg);
        }
    }
    //导入Excel
    protected function Import($exclePath)
    {
        $file_name = ROOT_PATH . 'public' . DS . 'excel' . DS . $exclePath;   //上传文件的地址
//        die($file_name);
        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
        $obj_PHPExcel =$objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
        $excel_array=$obj_PHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        return $excel_array;
    }
    /**

     * excel表格导出

     * @param string $fileName 文件名称

     * @param array $headArr 表头名称

     * @param array $data 要导出的数据

     * @author static7  */
    function excelExport($fileName = "", $headArr = [], $data = []) {
        $fileName .= "_" . date("Y_m_d", Request::instance()->time()) . ".xls";

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties();

        $key = ord("A"); // 设置表头

        foreach ($headArr as $v) {

            $colum = chr($key);

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);

            $key += 1;

        }

        $column = 2;

        $objActSheet = $objPHPExcel->getActiveSheet();

        foreach ($data as $key => $rows) { // 行写入

            $span = ord("A");

            foreach ($rows as $keyName => $value) { // 列写入

                $objActSheet->setCellValue(chr($span) . $column, $value);

                $span++;

            }

            $column++;

        }
        $fileName = iconv("utf-8", "gb2312", $fileName); // 重命名表

        $objPHPExcel->setActiveSheetIndex(0); // 设置活动单指数到第一个表,所以Excel打开这是第一个表

        header('Content-Type: application/vnd.ms-excel');

        header("Content-Disposition: attachment;filename=$fileName");

        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $objWriter->save('php://output'); // 文件通过浏览器下载

        exit();

    }
}