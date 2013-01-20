<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Url
 */
class Url
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $original;

    /**
     * @var string
     */
    private $generated;


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
     * Set original
     *
     * @param string $original
     * @return Url
     */
    public function setOriginal($original)
    {
        $this->original = $original;
    
        return $this;
    }

    /**
     * Get original
     *
     * @return string 
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set generated
     *
     * @param string $generated
     * @return Url
     */
    public function setGenerated($generated)
    {
        $this->generated = $generated;
    
        return $this;
    }

    /**
     * Get generated
     *
     * @return string 
     */
    public function getGenerated()
    {
        return $this->generated;
    }
    /**
     * @var \DateTime
     */
    private $created;


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Url
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * @var \Href\ShortyBundle\Entity\Stats
     */
    private $stats;


    /**
     * Set stats
     *
     * @param \Href\ShortyBundle\Entity\Stats $stats
     * @return Url
     */
    public function setStats(\Href\ShortyBundle\Entity\Stats $stats = null)
    {
        $this->stats = $stats;
    
        return $this;
    }

    /**
     * Get stats
     *
     * @return \Href\ShortyBundle\Entity\Stats 
     */
    public function getStats()
    {
        return $this->stats;
    }
    /**
     * @var \Href\ShortyBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Href\ShortyBundle\Entity\User $user
     * @return Url
     */
    public function setUser(\Href\ShortyBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Href\ShortyBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}