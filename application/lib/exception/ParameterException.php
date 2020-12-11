<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/29
 * Time: 上午5:51
 */

namespace app\lib\exception;

class ParameterException extends BaseException
{
    public $code = 400;

    public $msg = '参数错误';

    public $errorCode = 10000;
}