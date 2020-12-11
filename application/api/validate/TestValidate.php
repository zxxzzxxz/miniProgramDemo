<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午4:36
 */

namespace app\api\validate;

use think\Validate;


class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
}