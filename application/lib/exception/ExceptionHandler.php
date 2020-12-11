<?php
/**
 * Created by PhpStorm.
 * User: zhaoxin
 * Date: 2020/2/22
 * Time: 上午7:51
 */

namespace app\lib\exception;

use think\Log;
use think\Request;
use app\api\validate\BaseValidate;
use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    // 返回客户端当前请求的url路径
    public function render(Exception $e)
    {
        // return json('~~~~~~~~~~~~~');
        // 自定义异常
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            // 框架自带的异常格式
            // Config::get('app_debug');   //  调试模式
            if (config('app_debug')) {
                // return default error page
                return parent::render($e);
            } else {
                // 返回模式
                $this->code = 500;
                $this->msg = '服务器内部错误,不想告诉你';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();

        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];

        return json($result, $this->code);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  LOG_PATH,
            'level' => ['error']
        ]);
//        Log::record($e->getTraceAsString());
        Log::record($e->getMessage(),'error');
    }

}