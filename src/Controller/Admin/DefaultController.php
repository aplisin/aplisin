<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class DefaultController
 * @package App\Controller\Admin
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DefaultController extends BaseController
{
    public function index()
    {
        return $this->render('admin/default/index.html.twig');
    }
}