<?php

namespace app\api\model;

use think\Db;
use think\Model;

class Image extends BaseModel
{
    // 需要隐藏的字段
    protected $hidden = ['id', 'from', 'delete_time', 'update_time'];

    public function getUrlAttr($value, $data) {
        return $this->prefixImgUrl($value, $data);
    }
}
