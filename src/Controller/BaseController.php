<?php

namespace App\Controller;

use App\Common\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{
    /**
     * @return bool
     * @throws \Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException
     */
    protected function isLogin(): bool
    {
        return $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
    }

    protected function trans($messages)
    {
        return $this->get('translator')->trans($messages);
    }

    /**
     * @param Request $request
     * @param $query
     * @param int $limit
     * @return array
     */
    protected function paginate(Request $request, $query, $limit = 20): array
    {
        $page = (int)$request->query->get('page');

        $paginator = new Paginator($query, false);
        $paginator->getQuery()->setMaxResults($limit);

        $lastPage = ceil($paginator->count() / $paginator->getQuery()->getMaxResults()) ?: 1;

        if ($page > $lastPage) {
            $page = $page <= 0 ? 1 : $lastPage;
        } else {
            $page = $page <= 0 ? 1 : $page;
        }

        $paginator->getQuery()->setFirstResult($limit * ($page - 1));

        $paginator->setBaseUrl($request->getRequestUri());

        $paginatorBag = [
            'firstPage' => 1,
            'lastPage' => $lastPage,
            'currentPage' => $page,
            'prevPage' => $page - 1 < 1 ? 1 : $page - 1,
            'nextPage' => $page + 1 > $lastPage ? $lastPage : $page + 1,
        ];

        $previousRange = round(6 / 2);
        $nextRange = 7 - $previousRange - 1;

        $start = $paginatorBag['currentPage'] - $previousRange;
        $start = $start <= 0 ? 1 : $start;

        $pages = range($start, $paginatorBag['currentPage']);

        $end = $paginatorBag['currentPage'] + $nextRange;
        $end = $end > $paginatorBag['lastPage'] ? $paginatorBag['lastPage'] : $end;

        if ($paginatorBag['currentPage'] + 1 <= $end) {
            $pages = array_merge($pages, range($paginatorBag['currentPage'] + 1, $end));
        }
        $paginatorBag['pages'] = $pages;

        return [$paginator, $paginatorBag];
    }

    protected function createJsonResponse($data = null, $status = 200, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * @param null $data
     * @param string $callback
     * @param int $status
     * @param array $headers
     * @return $this
     * @throws \InvalidArgumentException
     */
    protected function createJsonpResponse($data = null, $callback = 'callback', $status = 200, array $headers = []): self
    {
        $response = $this->createJsonResponse($data, $status, $headers);

        return $response->setCallback($callback);
    }

    protected function createSuccessJsonResponse(array $data = [])
    {
        $data = array_merge(['success' => 1], $data);

        return $this->createJsonResponse($data);
    }

    protected function createFailJsonResponse(array $data = [])
    {
        $data = array_merge(['success' => 0], $data);

        return $this->createJsonResponse($data);
    }

    /**
     * 判断是否微信内置浏览器访问.
     *
     * @return bool
     */
    protected function isWxClient(): bool
    {
        return $this->isMobileClient() && false !== strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger');
    }

    /**
     * @return bool
     */
    protected function isMobileClient(): bool
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }

        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset($_SERVER['HTTP_VIA'])) {
            //找不到为flase,否则为true
            return false !== stripos($_SERVER['HTTP_VIA'], 'wap');
        }

        //判断手机发送的客户端标志,兼容性有待提高
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = [
                'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp',
                'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu',
                'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi',
                'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile',
            ];

            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match('/('.implode('|', $clientkeywords).')/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }

        //协议法，因为有可能不准确，放到最后判断
        if (isset($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((false !== strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml'))
                && (false === strpos($_SERVER['HTTP_ACCEPT'], 'text/html')
                    || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))
                )) {
                return true;
            }
        }

        return false;
    }
}