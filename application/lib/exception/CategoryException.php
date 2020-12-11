<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午8:30
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;

    public $msg = '指定类目不存在，请检查参数';

    public $errorCode = 50000;
}