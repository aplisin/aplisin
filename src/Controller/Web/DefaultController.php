<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Web;

use App\Controller\AbstractBaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractBaseController
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('web/default/index.html.twig');
    }
}
