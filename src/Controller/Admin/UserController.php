<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Form\User\SearchUserType;
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
    public function indexAction(Request $request)
    {
        $form = $this->createForm(
            SearchUserType::class,
            null,
            [
                'method' => 'GET'
            ]
        );

        $fields = [];
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fields = $form->getData();
        }

        $conditions = array();
        $conditions = array_merge($conditions, $fields);
        $orderBys = array('createdAt' => 'DESC');
        $query = $this->getUserService()->getQueryBuilder($conditions, $orderBys);
        list($paginator, $paginatorBag) = $this->paginate(
            $request,
            $query
        );

        /* @var $paginator Paginator */
        $users = $paginator->getIterator();

        return $this->render('admin/user/index.html.twig', array(
            'form' => $form->createView(),
            'users' => $users,
            'paginator' => $paginator,
            'paginatorBag' => $paginatorBag
        ));
    }

    protected function getUserService()
    {
        return $this->get('app.service.user.user_service');
    }
}