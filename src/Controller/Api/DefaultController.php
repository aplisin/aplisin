<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package App\Controller\Api
 */
class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        return new JsonResponse($this->getUser()->getUsername());
    }
}