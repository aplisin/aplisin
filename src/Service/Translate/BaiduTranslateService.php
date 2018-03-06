<?php

namespace App\Service\Translate;

use App\Service\BaseService;

class BaiduTranslateService extends BaseService
{
    protected $baseUrl = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    /**
     * @param $message
     * @param $locale
     * @return string
     * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     * @throws \Exception
     */
    public function translate($message, $locale): string
    {
        $appid = $this->container->getParameter('baidu_translate_appid');
        $ecretkey = $this->container->getParameter('baidu_translate_secret_key');

        $dst = '';
        if ((isset($appid) && !empty($appid)) && (isset($ecretkey) && !empty($ecretkey))) {
            $locale = explode('_', $locale)[0];

            $params = [
                'q' => $message,
                'from' => 'en',
                'to' => $locale,
                'appid' => $appid,
                'salt' => random_int(10000,99999),
            ];

            $params['sign'] = md5($appid.$message.$params['salt'].$ecretkey);
            $response = $this->sendRequest('post', $this->baseUrl, $params);

            if ($response) {
                $data = json_decode($response, true);
                $dst = $data['trans_result'][0]['dst'];
            } else {
                $dst = $message;
            }
        }

        return $dst;
    }

}