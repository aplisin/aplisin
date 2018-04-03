<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\User\User;
use App\Form\User\EditUserType;
use App\Form\User\SearchUserType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function indexAction(Request $request): Response
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
        [$paginator, $paginatorBag] = $this->paginate(
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
     * @param User $oneUser
     * @Cache(lastModified="oneUser.getUpdatedAt()", etag="'User' ~ oneUser.getId() ~ oneUser.getUpdatedAt().getTimestamp()")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(User $oneUser): Response
    {
        return $this->render('admin/user/show-modal.html.twig', ['user' => $oneUser]);
    }

    /**
     * @param Request $request
     * @param User $oneUser
     * @return Response
     */
    public function editAction(Request $request, User $oneUser): Response
    {
        $form = $this->createForm(EditUserType::class, $oneUser);

        $form->handleRequest($request);
        return $this->render('admin/user/edit-modal.html.twig', [
            'user' => $oneUser,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param User $oneUser
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function lockAction(Request $request, User $oneUser): Response
    {
        if ($request->isMethod('POST')) {
            $this->getUserService()->lockUser($oneUser);
        }

        return $this->render('admin/user/table-tr.html.twig', [
            'user' => $oneUser
        ]);
    }

    protected function getUserService()
    {
        return $this->get('app.service.user.user_service');
    }
}