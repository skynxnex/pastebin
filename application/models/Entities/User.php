<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\User
 */
class User
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
     * @var string $user_name
     */
    private $user_name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $activation_code
     */
    private $activation_code;

    /**
     * @var integer $active
     */
    private $active;

    /**
     * @var integer $admin
     */
    private $admin;

    /**
     * @var date $last_login
     */
    private $last_login;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $snippets;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $reports;

    public function __construct()
    {
        $this->snippets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return User
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
     * Set user_name
     *
     * @param string $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->user_name = $userName;
        return $this;
    }

    /**
     * Get user_name
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set activation_code
     *
     * @param string $activationCode
     * @return User
     */
    public function setActivationCode($activationCode)
    {
        $this->activation_code = $activationCode;
        return $this;
    }

    /**
     * Get activation_code
     *
     * @return string 
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set admin
     *
     * @param integer $admin
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * Get admin
     *
     * @return integer 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set last_login
     *
     * @param date $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;
        return $this;
    }

    /**
     * Get last_login
     *
     * @return date 
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Add snippets
     *
     * @param Entities\Snippet $snippets
     * @return User
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

    /**
     * Add reports
     *
     * @param Entities\Report $reports
     * @return User
     */
    public function addReport(\Entities\Report $reports)
    {
        $this->reports[] = $reports;
        return $this;
    }

    /**
     * Get reports
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReports()
    {
        return $this->reports;
    }
}