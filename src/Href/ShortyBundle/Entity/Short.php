<?php

namespace Href\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Short
 */
class Short
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $short;


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
     * Set short
     *
     * @param string $short
     * @return Short
     */
    public function setShort($short)
    {
        $this->short = $short;
    
        return $this;
    }

    /**
     * Get short
     *
     * @return string 
     */
    public function getShort()
    {
        return $this->short;
    }
}
