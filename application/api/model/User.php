<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午9:37
 */

namespace app\api\model;


class User extends BaseModel
{
    public static function getByOpenID($openid) {
        $user = self::where('openid', '=', $openid)->find();

        return $user;
    }
}