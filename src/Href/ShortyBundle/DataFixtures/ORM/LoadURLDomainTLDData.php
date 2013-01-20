<?php

namespace Href\ShortyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Href\ShortyBundle\Entity\Url;
use Href\ShortyBundle\Entity\Domain;
use Href\ShortyBundle\Entity\Tld;

class LoadURLDomainTLDData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $url = new Url();
        $url->setOriginal('http://lenta.ru/news/2013/01/19/biathlon/');
        $url->setGenerated('Ga4U0d');
        $url->setCreated(new \DateTime());

        $domain = new Domain();
        $domain->setName('lenta.ru');
        $domain->setCount(1);

        $tld = new Tld();
        $tld->setName('ru');
        $tld->setCount(1);

        $manager->persist($url);
        $manager->persist($domain);
        $manager->persist($tld);
        $manager->flush();
    }
}