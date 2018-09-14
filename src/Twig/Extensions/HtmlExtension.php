<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Extensions;

use App\DataStructure\UniquePriorityQueue;

/**
 * Class HtmlExtension
 */
class HtmlExtension extends \Twig_Extension
{
    protected $scripts = array();

    protected $csses = array();

    /**
     * HtmlExtension constructor.
     */
    public function __construct()
    {
        $this->scripts = new UniquePriorityQueue();
        $this->csses = new UniquePriorityQueue();
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions(): array
    {
        return array(
            new \Twig_SimpleFunction('script', array($this, 'script')),
            new \Twig_SimpleFunction('css', array($this, 'css')),
        );
    }

    /**
     * @param null $paths
     * @param int  $priority
     *
     * @return UniquePriorityQueue|array
     */
    public function script($paths = null, int $priority = 0)
    {
        if (empty($paths)) {
            return $this->scripts;
        }

        if (!\is_array($paths)) {
            $paths = array($paths);
        }

        foreach ($paths as $path) {
            $this->scripts->insert($path, $priority);
        }

        return $this->scripts;
    }

    /**
     * @param null $paths
     * @param int  $priority
     *
     * @return UniquePriorityQueue|array
     */
    public function css($paths = null, int $priority = 0)
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

        return $this->csses;
    }
}
