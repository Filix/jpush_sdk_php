<?php
namespace Filix\JpushBundle\Util;

/**
 * JPush
 *
 * @author Filix
 * @email syp.syl@gmail.com
 */
class JPush
{

    const API_URL = 'http://api.jpush.cn:8800/v2/push';
    const SAPI_URL = 'https://api.jpush.cn:443/v2/push';

    protected $master_secret;
    protected $app_key;
    protected $request;
    protected $api_url;
    protected $error;

    /**
     * @param string $masterSecret
     * @param string $appkeys
     */
    public function __construct($masterSecret = '', $appkeys = '')
    {
        $this->master_secret = $masterSecret;
        $this->app_key = $appkeys;
        $this->request = new Request();
        $this->api_url = self::API_URL;
    }

    public function setSecurity($security)
    {
        $this->api_url = $security ? self::SAPI_URL : self::API_URL;
    }

    public function send(Message $message)
    {
        $res = $this->request->post($this->api_url, $this->formatMessage($message));
        if ($res === false) {
            $this->setError('请求出错');
            return false;
        }
        $res_arr = json_decode($res, true);
        $code = intval($res_arr['errcode']);
        if ($code === 0) {
            return true;
        }
        $this->getErrorInfo($code);
        return false;
    }
    
    protected function getErrorInfo($error_code){
        switch ($error_code) {
            case 10:
                $this->setError('系统内部错误');
                break;
            case 1001:
                $this->setError('只支持 HTTP Post 方法，不支持 Get 方法');
                break;
            case 1002:
                $this->setError('缺少了必须的参数');
                break;
            case 1003:
                $this->setError('参数值不合法');
                break;
            case 1004:
                $this->setError('验证失败');
                break;
            case 1005:
                $this->setError('消息体太大');
                break;
            case 1007:
                $this->setError('receiver_value 参数非法');
                break;
            case 1008:
                $this->setError('appkey参数非法');
                break;
            case 1010:
                $this->setError('msg_content 不合法');
                break;
            case 1011:
                $this->setError('没有满足条件的推送目标');
                break;
            case 1012:
                $this->setError('iOS 不支持推送自定义消息。只有 Android 支持推送自定义消息');
                break;
            default:
                $this->setError('未知错误');
                break;
        }
    }

    protected function formatMessage(Message $message){
        $param = '';
        $param .= '&sendno=' . $message->getSendno();
        $param .= '&app_key=' . $this->app_key;
        $param .= '&receiver_type=' . $message->getReceiverType();
        $param .= '&receiver_value=' . implode(',', $message->getReceiverValue());
        $verification_code = md5($message->getSendno() . $message->getReceiverType() . implode(',', $message->getReceiverValue()) . $this->master_secret);
        $param .= '&verification_code=' . $verification_code;
        $param .= '&msg_type=' . $message->getMsgType();
        $param .= '&msg_content=' . json_encode($message->getMsgContent());
        $param .= '&platform=' . implode(',', $message->getPlatform());
        return $param;
    }

    protected function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

}
