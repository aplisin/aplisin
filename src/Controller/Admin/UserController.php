<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller\Admin
 * @Security("is_granted('ROLE_ADMIN')")
 */
class UserController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $page = (int)$request->query->get('page');

        $conditions = array('username' => 'user');

        $query = $this->getUserService()->getQueryBuilder($conditions, 'u');
        list($paginator, $paginatorBag) = $this->paginate(
            $request->getPathInfo(),
            $query,
            $page <= 0 ? 1 : $page
        );

        /* @var $paginator Paginator */
        $users = $paginator->getIterator();

        return $this->render('admin/user/index.html.twig', compact(
            'users',
            'paginator',
            'paginatorBag'
        ));
    }

    protected function getUserService()
    {
        return $this->get('service.user.user_service');
    }
}