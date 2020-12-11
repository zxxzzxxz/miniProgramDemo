<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午4:07
 */

namespace app\api\controller\v1;

use app\lib\exception\BannerMissException;
use think\Validate;
use think\Loader;
use app\api\validate\TestValidate;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use think\Exception;

class Banner
{

    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @param $id
     * @return mixed
     * @http GET
     *
     */
    public function getBanner($id)
    {
        // 三种不同的调用方式
        // $validate = Loader::validate('IDMustBePositiveInt');
        // $validate->goCheck();

        (new IDMustBePositiveInt())->goCheck();

        // get, find, all, select, Db没有all和get
        // $banner = BannerModel::with(['items', 'items.img'])->find($id);
        $banner = BannerModel::getBannerByID($id);

        // $banner->hidden(['update_time', 'delete_time']);
        // $banner->visible(['id', 'description']);
        // $banner = new BannerModel();
        // $banner = $banner->get($id);

        if (!$banner) {
//             throw new Exception();
            throw new BannerMissException();  //  测试日志系统
        }

        return json($banner);
    }
}
