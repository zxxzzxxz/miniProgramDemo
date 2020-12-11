<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午4:59
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Request;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        // 'num' => 'in:1,2,3',
    ];

    protected $message = [
        'id' => '必须是正整数'
    ];
}