<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/3/1
 * Time: 下午9:38
 */

namespace app\api\service;

use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User;
use app\lib\exception\TokenException;

class UserToken
{
    protected $code;

    protected $wxAppID;

    protected $wxAppSecret;

    protected $wxLoginUrl;

    public function __construct($code) {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    public function get($code) {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_encode($result, true);

        if (empty($wxResult)) {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError();
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }


    // 获取登录错误信息
    private function processLoginError($wxResult) {
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']
            ]);
    }

    // 颁发令牌
    // 只要调用登陆就颁发新令牌
    private function grantToken($wxResult)
    {
        // 此处生成令牌使用的是TP5自带的令牌
        // 如果想要更加安全可以考虑自己生成更复杂的令牌
        // 比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
        //        $token = Request::instance()->token('token', 'md5');
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);

        if (!$user) {
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
            $uid = $this->newUser($openid);
        }
        else {
            $uid = $user->id;
        }

        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    // 插入一个新用户
    private function newUser($openid) {
        $user = User::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    // 准备value的数据
    private function prepareCachedValue($wxResult, $uid) {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    // 写入缓存
    private function saveToCache($wxResult) {
        // 这里用的文件缓存
        $key = self::generateToken();
        $value = json_encode($wxResult);
        $expire_in = config('setting.token_expire_in');
        $result = cache($key, $value, $expire_in);

        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }
}