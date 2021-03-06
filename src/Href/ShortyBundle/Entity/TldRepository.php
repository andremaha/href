<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TldRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TldRepository extends EntityRepository
{
    public function getTopTen()
    {
        $query = $this->createQueryBuilder('t')
            ->orderBy('t.count', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        return $query->getResult();
    }
}
