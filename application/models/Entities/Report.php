<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Report
 */
class Report
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $cause
     */
    private $cause;

    /**
     * @var datetime $report_date
     */
    private $report_date;

    /**
     * @var integer $viewed
     */
    private $viewed;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $snippet;

    /**
     * @var Entities\User
     */
    private $user;

    public function __construct()
    {
        $this->snippet = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set url
     *
     * @param string $url
     * @return Report
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
     * Set cause
     *
     * @param string $cause
     * @return Report
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
        return $this;
    }

    /**
     * Get cause
     *
     * @return string 
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * Set report_date
     *
     * @param datetime $reportDate
     * @return Report
     */
    public function setReportDate($reportDate)
    {
        $this->report_date = $reportDate;
        return $this;
    }

    /**
     * Get report_date
     *
     * @return datetime 
     */
    public function getReportDate()
    {
        return $this->report_date;
    }

    /**
     * Set viewed
     *
     * @param integer $viewed
     * @return Report
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
     * Add snippet
     *
     * @param Entities\Snippet $snippet
     * @return Report
     */
    public function addSnippet(\Entities\Snippet $snippet)
    {
        $this->snippet[] = $snippet;
        return $this;
    }

    /**
     * Get snippet
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * Set user
     *
     * @param Entities\User $user
     * @return Report
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