<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午6:57
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}