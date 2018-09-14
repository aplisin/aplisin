<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataStructure;

/**
 * Class UniquePriorityQueue
 */
class UniquePriorityQueue extends \SplPriorityQueue
{
    protected $values = array();

    protected $serial = PHP_INT_MAX;

    /**
     * @param mixed $value
     * @param mixed $priority
     */
    public function insert($value, $priority): void
    {
        if (isset($this->values[$value])) {
            return;
        }

        parent::insert($value, array($priority, $this->serial--));
        $this->values[$value] = true;
    }
}
