<?php

namespace App\Service\Translate;

use App\Service\BaseService;

class BaiduTranslateService extends BaseService
{
    private $baseUrl = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    public function translate($message, $locale)
    {
        $appid = $this->container->getParameter('env(baidu_translate_appid)');
        $salt = $this->container->getParameter('env(baidu_translate_salt)');
        $sign = md5($appid . $message . $salt);

        $locale = explode('_', $locale)[0];

        $params = array(
            'q' => $message,
            'from' => 'en',
            'to' => $locale,
            'appid' => $appid,
            'salt' => $salt,
            'sign' => $sign
        );

        $response = $this->sendRequest('get', $this->baseUrl, $params);
        return json_decode($response, true)['trans_result'][0]['dst'];
    }
}