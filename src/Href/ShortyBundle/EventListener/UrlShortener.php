<?php

namespace Href\ShortyBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Href\ShortyBundle\Shorteners\Shortener;
use Href\ShortyBundle\Entity\Url;

/**
 * Event that is launched to shorten urls
 * Laying this off, since the testing is much harder with no way of setting the generated values -
 * and then now way of following the stats.
 * Much easier is to control the output with fixtures.
 *
 * @author      Andrey I. Esaulov <aesaulov@me.com>
 * @package     href
 * @version     0.2
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
