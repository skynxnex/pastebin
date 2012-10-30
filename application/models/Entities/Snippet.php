<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Snippet
 */
class Snippet
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $headline
     */
    private $headline;

    /**
     * @var text $snippet
     */
    private $snippet;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var integer $visibility
     */
    private $visibility;

    /**
     * @var date $date
     */
    private $date;

    /**
     * @var integer $deleted
     */
    private $deleted;

    /**
     * @var integer $viewed
     */
    private $viewed;

    /**
     * @var Entities\Encoding
     */
    private $encoding;

    /**
     * @var Entities\User
     */
    private $user;


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
     * Set headline
     *
     * @param string $headline
     * @return Snippet
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set snippet
     *
     * @param text $snippet
     * @return Snippet
     */
    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;
        return $this;
    }

    /**
     * Get snippet
     *
     * @return text 
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Snippet
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set visibility
     *
     * @param integer $visibility
     * @return Snippet
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
        return $this;
    }

    /**
     * Get visibility
     *
     * @return integer 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return Snippet
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Snippet
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set viewed
     *
     * @param integer $viewed
     * @return Snippet
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
        return $this;
    }

    /**
     * Get viewed
     *
     * @return integer 
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * Set encoding
     *
     * @param Entities\Encoding $encoding
     * @return Snippet
     */
    public function setEncoding(\Entities\Encoding $encoding = null)
    {
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * Get encoding
     *
     * @return Entities\Encoding 
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set user
     *
     * @param Entities\User $user
     * @return Snippet
     */
    public function setUser(\Entities\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Entities\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}