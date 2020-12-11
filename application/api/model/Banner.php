<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午6:46
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    // 隐藏的字段
    protected $hidden = ['update_time', 'delete_time'];

    public function items() {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id) {
        // $result = Db::query('select * from banner_item where banner_id=?', [$id]);
        /* $result = Db::table('banner_item')

            ->fetchSql()
            ->where(function ($query) use ($id){
                $query->where('banner_id', '=', $id);
            })
            ->select();*/

        $result = self::with(['items', 'items.img'])->find($id);

        return $result;
    }

}