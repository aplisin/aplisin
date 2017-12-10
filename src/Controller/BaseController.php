<?php

namespace App\Controller;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfToken;

class BaseController extends Controller
{
    protected function isLogin()
    {
        return $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
    }

    protected function createMessageResponse($type, $message, $title = '')
    {
        if (!\in_array($type, array('info', 'warning', 'error'), true)) {
            throw new \RuntimeException('type error');
        }

        return $this->render('web/default/message.html.twig', array(
            'type' => $type,
            'message' => $message,
            'title' => $title
        ));
    }

    protected function paginate(string $path, $query, $page = 1, $limit = 1)
    {
        $paginator = new Paginator($query, false);
        $paginator->getQuery()
            ->setMaxResults($limit)
            ->setFirstResult($limit * ($page - 1));

        $uri = explode('/', $path);
        unset($uri[0]);
        $uri = implode('_', $uri);

        $paginatorBag = array(
            'firstPage' => 1,
            'lastPage' => (int)round(($paginator->count() / $paginator->getQuery()->getMaxResults())),
            'currentPage' => $page,
            'uri' => $uri
        );

        $previousRange = round(10 / 2);
        $nextRange = 10 - $previousRange - 1;

        $start = $paginatorBag['currentPage'] - $previousRange;
        $start = $start <= 0 ? 1 : $start;

        $pages = range($start, $paginatorBag['currentPage']);

        $end = $paginatorBag['currentPage'] + $nextRange;
        $end = $end > $paginatorBag['lastPage'] ? $paginatorBag['lastPage'] : $end;

        if ($paginatorBag['currentPage'] + 1 <= $end) {
            $pages = array_merge($pages, range($paginatorBag['currentPage'] + 1, $end));
        }
        $paginatorBag['pages'] = $pages;

        return array($paginator, $paginatorBag);
    }
}