<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午6:52
 */

namespace app\api\controller\v1;

use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;
use app\api\validate\IDMustBePositiveInt;
// use app\api\model\Product as ProductModel;

class Product
{
    /**
     * @param int $count
     * @return false|\PDOStatement|string|\think\Collection
     * @throws ProductException
     * @throws \app\lib\exception\ParameterException
     * 获取最近的商品信息
     */
    public function getRecent($count = 15) {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);

        if (!$products) {
            throw new ProductException();
        }

        // $collection = collection($products);  // collection对象
        $products = $products->hidden(['summary']);

        return $products;
    }

    /**
     * 获取某分类下全部商品
     */
    public function getAllInCategory($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID(
            $id, false);
        if ($products->isEmpty())
        {
            throw new ThemeException();
        }
        $data = $products
            ->hidden(['summary'])
            ->toArray();
        return $data;
    }


    /**
     * 获取单件商品详情
     */
    public function getOne($id) {
        (new IDMustBePositiveInt())->goCheck();
        return 'success';
    }
}