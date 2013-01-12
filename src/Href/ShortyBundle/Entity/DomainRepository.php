<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DomainRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DomainRepository extends EntityRepository
{
    public function getTopTen()
    {
        $query = $this->createQueryBuilder('d')
            ->orderBy('d.count', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        return $query->getResult();
    }
}