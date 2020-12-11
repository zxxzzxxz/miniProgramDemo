<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/2
 * Time: 上午4:10
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;

    public $msg = 'Token已过期或者无效';

    public $errorCode = 10001;
}