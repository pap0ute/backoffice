<?php

namespace TP\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    public function lastProductList()
    {
        $qb = $this->createQueryBuilder('a');

        $qb->orderBy('a.createDate', 'DESC');
        $qb->setmaxResults(2); // Les 2 derniers Product

        return $qb->getQuery()->getResult();
    }
}