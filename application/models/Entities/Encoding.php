<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Encoding
 */
class Encoding
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $snippets;

    public function __construct()
    {
        $this->snippets = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return Encoding
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Encoding
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add snippets
     *
     * @param Entities\Snippet $snippets
     * @return Encoding
     */
    public function addSnippet(\Entities\Snippet $snippets)
    {
        $this->snippets[] = $snippets;
        return $this;
    }

    /**
     * Get snippets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSnippets()
    {
        return $this->snippets;
    }
}