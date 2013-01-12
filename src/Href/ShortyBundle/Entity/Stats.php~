<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stats
 */
class Stats
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var integer
     */
    private $count;


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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Stats
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Stats
     */
    public function setCount($count)
    {
        $this->count = $count;
    
        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }
    /**
     * @var \Href\ShortyBundle\Entity\Url
     */
    private $url;


    /**
     * Set url
     *
     * @param \Href\ShortyBundle\Entity\Url $url
     * @return Stats
     */
    public function setUrl(\Href\ShortyBundle\Entity\Url $url = null)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return \Href\ShortyBundle\Entity\Url 
     */
    public function getUrl()
    {
        return $this->url;
    }
}