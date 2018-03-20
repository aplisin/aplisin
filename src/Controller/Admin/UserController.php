<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\User\User;
use App\Form\User\SearchUserType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
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

        return $this->render('admin/user/index.html.twig', [
            'form' => $form->createView(),
            'users' => $users,
            'paginator' => $paginator,
            'paginatorBag' => $paginatorBag
        ]);
    }

    /**
     * @param User $user
     * @Cache(lastModified="user.getUpdatedAt()", etag="'User' ~ user.getId() ~ user.getUpdatedAt().getTimestamp()")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(User $user)
    {
        return $this->render('admin/user/show-modal.html.twig', compact('user'));
    }

    protected function getUserService()
    {
        return $this->get('app.service.user.user_service');
    }
}