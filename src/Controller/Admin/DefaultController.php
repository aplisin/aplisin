<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends BaseController
{
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/default/index.html.twig');
    }
}