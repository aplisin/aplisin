<?php

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

abstract class BaseRepository extends ServiceEntityRepository
{
    protected $conditions;

    public function getQueryBuilder(array $conditions, $alias, $indexBy = null)
    {
        $this->conditions = $conditions;
        return $this->createQueryBuilder('u', null)->getQuery();
    }

    public function createQueryBuilder($alias, $indexBy = null)
    {
        $this->conditions = array_filter(
            $this->conditions,
            function ($value) {
                if ($value === '' || $value === null) {
                    return false;
                }

                if (is_array($value) && empty($value)) {
                    return false;
                }

                return true;
            }
        );

        $builder = parent::createQueryBuilder($alias, $indexBy);
        $declares = $this->declares();
        $declares['where'] = isset($declares['where']) ? $declares['where'] : array();

        foreach ($declares['where'] as $where) {
            $key = explode(':', $where)[1];

            if (isset($this->conditions[$key]) && !empty($this->conditions[$key])) {
                $matched = preg_match('/\s+((PRE_|SUF_)?LIKE)\s+/i', $where, $matches);
                $value = $this->conditions[$key];

                if ($matched) {
                    switch ($matches[1]) {
                        case 'LIKE':
                            $value = '%' . $value . '%';
                            break;
                        case 'SUF_LIKE':
                            $where = preg_replace('/SUF_LIKE/i', 'LIKE', $where, 1);
                            $value = '%' . $value;
                            break;
                        case 'PRE_LIKE':
                            $where = preg_replace('/PRE_LIKE/i', 'LIKE', $where, 1);
                            $value = $value . '%';
                            break;
                    }
                }

                $builder->andWhere($where);
                $builder->setParameter($key, $value);
            }
        }

        return $builder;
    }

    protected function declares()
    {
        return array();
    }
}