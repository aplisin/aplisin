<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller\Admin
 * @Security("is_granted('ROLE_ADMIN')")
 */
class UserController extends BaseController
{
    public function index(Request $request)
    {
        return $this->render('admin/user/index.html.twig');
    }
}