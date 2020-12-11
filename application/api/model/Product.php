<?php

namespace app\api\model;

use think\Model;
// use app\api\model\Product as ProductModel;

class Product extends BaseModel
{
    // 隐藏的数据  在数据库里没有pivot， 多对多时tp5会自动带的一个数据
    protected $hidden = ['delete_time', 'create_time', 'update_time', 'main_img_id', 'pivot', 'from', 'category_id' ];

    // 图片添加url前缀
    public function getMainImgUrlAttr($value, $data) {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count) {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    /**
     * 获取某分类下商品
     * @param $categoryID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getProductsByCategoryID(
        $categoryID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where('category_id', '=', $categoryID);
        if (!$paginate)
        {
            return $query->select();
        }
        else
        {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                'page' => $page
            ]);
        }
    }

    public static function getProductDetail($id) {

    }
}
