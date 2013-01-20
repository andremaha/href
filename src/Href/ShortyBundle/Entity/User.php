<?php

namespace Href\ShortyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{

    protected $id;

    public function __construct()
    {
        parent::__construct();
        // My logic goes here
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $urls;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add urls
     *
     * @param \Href\ShortyBundle\Entity\Url $urls
     * @return User
     */
    public function addUrl(\Href\ShortyBundle\Entity\Url $urls)
    {
        $this->urls[] = $urls;
    
        return $this;
    }

    /**
     * Remove urls
     *
     * @param \Href\ShortyBundle\Entity\Url $urls
     */
    public function removeUrl(\Href\ShortyBundle\Entity\Url $urls)
    {
        $this->urls->removeElement($urls);
    }

    /**
     * Get urls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUrls()
    {
        return $this->urls;
    }
}