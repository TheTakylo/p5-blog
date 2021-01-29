<?php

namespace App\Entity;

use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;

class User extends AbstractEntity
{

    /** @var int $id */
    private $id;

    /** @var string $email */
    private $email;

    /** @var string $password */
    private $password;

    /** @var string $firstname */
    private $firstname;

    /** @var string $lastname */
    private $lastname;

    /** @var int $is_admin */
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
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return int
     */
    public function getIs_admin(): int
    {
        return $this->is_admin;
    }

    /**
     * @param int $is_admin
     * @return User
     */
    public function setIs_admin(int $is_admin): User
    {
        $this->is_admin = $is_admin;
        return $this;
    }

}