<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->render('web/default/index.html.twig');
    }
}