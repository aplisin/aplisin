<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        return $this->render('@App/web/default/message.html.twig', array(
            'type' => $type,
            'message' => $message,
            'title' => $title
        ));
    }
}