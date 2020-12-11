<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午9:28
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'   // 区别不传和传空值
    ];

    protected $message = [
        'code' => '没有code不能获取信息'
    ];
}