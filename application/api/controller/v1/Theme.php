<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午2:12
 */

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * @url /theme?ids=id1,id2,id3...
     * @return 一组theme模型
     */
    public function getSimpleList($ids = '')  {
        (new IDCollection())->goCheck();

        $ids = explode(',', $ids);

        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);

        if ($result->isEmpty()) {
            throw new ThemeException();
        }

        return json($result);
    }

    /**
     *  @url /theme/:id
     */
    public function getComplexOne($id) {
        (new IDMustBePositiveInt())->goCheck();

        $result = ThemeModel::getThemeWithProducts($id);

        if ($result->isEmpty()) {
            throw new ThemeException();
        }
        return json($result);
    }
}