<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午7:16
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;

    public $msg = '指定的商品不存在';

    public $errorCode = 20000;
}
