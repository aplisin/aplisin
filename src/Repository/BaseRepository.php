<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception\InvalidArgumentException;

abstract class BaseRepository extends ServiceEntityRepository
{
    protected $conditions;

    protected $orderbys;

    abstract protected function declares();

    public function getQueryBuilder(array $conditions, array $orderBys, $alias, $indexBy = null)
    {
        $this->conditions = $conditions;
        $this->orderbys = $orderBys;
        return $this->appCreateQueryBuilder($alias, $indexBy)->getQuery();
    }

    /**
     * @param $alias
     * @param $indexBy
     * @return \Doctrine\ORM\QueryBuilder
     * @throws InvalidArgumentException
     */
    protected function appCreateQueryBuilder($alias, $indexBy)
    {
        $builder = $this->createQueryBuilder($alias, $indexBy);
        $declares = $this->declares();
        $declares['where'] = $declares['where'] ?? array();

        foreach ($declares['where'] as $where) {
            $key = explode(':', $where)[1];

            if (isset($this->conditions[$key]) && !empty($this->conditions[$key])) {
                $matched = preg_match('/\s+((PRE_|SUF_)?LIKE)\s+/i', $where, $matches);
                $value = $this->conditions[$key];

                if ($matched) {
                    switch ($matches[1]) {
                        case 'LIKE':
                            $value = '%'.$value.'%';
                            break;
                        case 'SUF_LIKE':
                            $where = preg_replace('/SUF_LIKE/i', 'LIKE', $where, 1);
                            $value = '%'.$value;
                            break;
                        case 'PRE_LIKE':
                            $where = preg_replace('/PRE_LIKE/i', 'LIKE', $where, 1);
                            $value .= '%';
                            break;
                    }
                }

                $builder->andWhere($where);
                $builder->setParameter($key, $value);
            }
        }

        foreach ($this->orderbys ?: array() as $order => $sort) {
            try {
                $this->checkOrderBy($order, $sort, $declares['orderbys']);
            } catch (InvalidArgumentException $e) {
                throw $e;
            }
            $builder->addOrderBy($alias.'.'.$order, $sort);
        }

        return $builder;
    }

    /**
     * @param $order
     * @param $sort
     * @param $allowOrderBys
     * @throws InvalidArgumentException
     */
    protected function checkOrderBy($order, $sort, $allowOrderBys)
    {
        if (!\in_array($order, $allowOrderBys, true)) {
            throw new InvalidArgumentException(sprintf("SQL order by field is only allowed '%s', but you give `{$order}`.", implode(',', $allowOrderBys)));
        }

        if (!\in_array(strtoupper($sort), array('ASC', 'DESC'), true)) {
            throw new InvalidArgumentException("SQL order by direction is only allowed `ASC`, `DESC`, but you give `{$sort}`.");
        }
    }
}