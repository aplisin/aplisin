<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfToken;

class BaseController extends Controller
{
    protected function isLogin()
    {
        return $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY');
    }

    protected function createMessageResponse($type, $message, $title = '')
    {
        if (!\in_array($type, array('info', 'warning', 'error'), true)) {
            throw new \RuntimeException('type error');
        }

        return $this->render('web/default/message.html.twig', array(
            'type' => $type,
            'message' => $message,
            'title' => $title
        ));
    }
}