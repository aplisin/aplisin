<?php

namespace App\Twig\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;

class TwigExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('is_pjax', array($this, 'isPjax'))
        );
    }

    public function isPjax()
    {
        $request = $this->container->get('request_stack');
        $pjax = $request->getCurrentRequest()->headers->get('x-pjax');

        return isset($pjax) && $pjax == true;
    }
}