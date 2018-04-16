<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        throw $this->createNotFoundException();
    }
}