<?php

namespace App\Controller\Web;

use App\Controller\BaseController;

class DefaultController extends BaseController
{
    public function index()
    {
        return $this->render('web/default/index.html.twig');
    }
}