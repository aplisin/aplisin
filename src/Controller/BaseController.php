<?php

namespace App\Controller;

use App\Common\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    protected function paginate(Request $request, $query, $limit = 20)
    {
        $page = (int)$request->query->get('page');

        $paginator = new Paginator($query, false);
        $paginator->getQuery()->setMaxResults($limit);

        $lastPage = ceil($paginator->count() / $paginator->getQuery()->getMaxResults()) ?: 1;
        $page = $page <= 0 ? 1 : ($page > $lastPage ? $lastPage : $page);
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
}