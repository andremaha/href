<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ShortRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ShortRepository extends EntityRepository
{
    public function getOneRandom()
    {
        $query = $this->createQueryBuilder('s')
            ->setMaxResults(1)
            ->getQuery();

        return $query->getSingleResult();
    }
}
