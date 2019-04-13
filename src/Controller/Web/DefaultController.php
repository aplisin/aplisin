<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 */
class DefaultController extends BaseController
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('web/default/index.html.twig');
    }
}
