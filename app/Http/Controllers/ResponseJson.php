<?php
/**
 * Created by PhpStorm.
 * User: 90853
 * Date: 2019/6/16
 * Time: 14:12
 */
namespace App\Http\Controllers;

trait ResponseJson
{
    /**
     * 当App接口出现业务异常时的返回
     * @param $code
     * @param $msg
     * @param array $data
     * @return false|string
     */
    public function jsonError($code,$msg,$data = [])
    {
        return $this->jsonResponse($code,$msg,$data);
    }
    /**
     * App接口请求成功时的返回
     * @param array $data
     * @return false|string
     */
    public function jsonSuccess( $data = [])
    {
        return $this->jsonResponse('1','Success',$data);
    }

    /**
     * App接请求删除含有二级子分类的一级分类的返回值
     * @param array $data
     * @return false|string
     */
    public function delete_first_Error($code,$msg,$data = [])
    {
        return $this->jsonResponse($code,$msg,$data);
    }


    /**
     * 返回一个json
     * @param $code
     * @param $msg
     * @param $data
     * @return false|string
     */
    private function jsonResponse($code,$msg,$data)
    {
        $content = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return json_encode($content);
    }
}