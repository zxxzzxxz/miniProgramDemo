<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    // 获取url并拼接字段
    protected function prefixImgUrl($value, $data) {
        $finalUrl = $value;
        if ($data['from'] == 1) {
            return config('setting.img_prefix') . $value;
        }
        return $finalUrl;
    }
}
