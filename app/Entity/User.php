<?php

namespace App\Entity;

use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;

class User extends AbstractEntity
{
    private $id;
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $is_admin;

    public $other;

    public static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @return SchemaParameter[]
     */
    public static function getSchema(): array
    {
        return [
            new SchemaParameter('id', 'id', 'int'),
            new SchemaParameter('email', 'email', 'string'),
            new SchemaParameter('password', 'password', 'string'),
            new SchemaParameter('firstname', 'firstname', 'string'),
            new SchemaParameter('lastname', 'lastname', 'string'),
            new SchemaParameter('is_admin', 'is_admin', 'int'),
        ];
    }

    public function __construct()
    {
        $this->is_admin = 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIs_admin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $is_admin
     * @return User
     */
    public function setIs_admin($is_admin)
    {
        $this->is_admin = $is_admin;
        return $this;
    }
}