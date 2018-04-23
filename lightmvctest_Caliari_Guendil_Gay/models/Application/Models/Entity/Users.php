<?php

namespace Application\Models\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity("Application\Models\Entity\Users")
 * @ORM\Table("users")
 */
 
 class Users{
	 /**
     * @ORM\Id
     * @ORM\Column(type="string", length=32)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $username;
	
	/**
     * @ORM\Column(type="string", length=32, name="password")
     */
	protected $password;
	
	/**
     * @ORM\Column(type="string", length=32, name="permission")
     */
	protected $permission;
	
	
	/**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = (string) $username;
    }
	
	/**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
    }
	 

	 /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->permission = (string) $permission;
    }


 }