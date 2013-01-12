<?php

namespace Href\ShortyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Href\ShortyBundle\Shorteners\Shortener;
use Href\ShortyBundle\Entity\Url;

/**
 * Event that is launched to shorten urls
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     href
 * @version     0.1
 */
class UrlShortener
{
    private $shortener;

    public function __construct(Shortener $shortener)
    {
        $this->shortener = $shortener;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Url) {
            $entity->setGenerated($this->shortener->shorten($entity->getOriginal()));
            $entity->setCreated(new \DateTime());
        }
    }
}
