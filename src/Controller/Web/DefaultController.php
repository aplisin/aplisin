<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
 public function index()
 {
     return $this->render('web/default/index.html.twig');
 }
}