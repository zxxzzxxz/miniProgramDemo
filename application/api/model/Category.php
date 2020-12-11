<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午8:21
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['create_time', 'update_time', 'delete_time'];

    public function img() {
        return $this->belongsTo('image', 'topic_img_id', 'id');
    }

    public function getProductsByCategoryID($categoryID) {
        $products = self::where('category_id', '=', $categoryID)->select();

        return $products;
    }
}