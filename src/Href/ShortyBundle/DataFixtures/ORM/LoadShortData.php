<?php

namespace Href\ShortyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Href\ShortyBundle\Entity\Short;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Populates short table with pre-generated URLs
 *
 */

class LoadShortData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $shortener = $this->container->get('href_shorty.shortener.random');

        $i = 0;
        while($i++ < 10) {
            $short = new Short();
            $short->setShort($shortener->shorten(''));
            $manager->persist($short);
        }
        $manager->flush();
    }
}