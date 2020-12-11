<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/2
 * Time: 上午3:17
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;

    public $msg = 'wechat unknown error';

    public $errorCode = 999;
}