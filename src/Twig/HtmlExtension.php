<?php

namespace App\Twig;

use App\DataStructure\UniquePriorityQueue;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HtmlExtension extends AbstractExtension
{
    protected $scripts = [];

    protected $csses = [];

    public function __construct()
    {
        $this->scripts = new UniquePriorityQueue();
        $this->csses = new UniquePriorityQueue();
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('script', [$this, 'script']),
            new TwigFunction('css', [$this, 'css']),
        ];
    }

    public function script($paths = null, $priority = 0)
    {
        if (empty($paths)) {
            return $this->scripts;
        }

        if (!\is_array($paths)) {
            $paths = [$paths];
        }

        foreach ($paths as $path) {
            $this->scripts->insert($path, $priority);
        }
    }

    public function css($paths = null, $priority = 0)
    {
        if (empty($paths)) {
            return $this->csses;
        }

        if (!\is_array($paths)) {
            $paths = array($paths);
        }

        foreach ($paths as $path) {
            $this->csses->insert($path, $priority);
        }
    }
}
