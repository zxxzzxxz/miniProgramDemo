<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午7:56
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;

    public $msg = '请求的banner不存在';

    public $errorCode = '100001';
}