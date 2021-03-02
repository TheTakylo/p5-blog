<?php

namespace App\Entity;

use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;

class Comment extends AbstractEntity
{

    private $id;
    private $postId;
    private $name;
    private $email;
    private $content;
    private $validated;
    private $createdAt;

    public $other;

    public static function getTableName(): string
    {
        return 'comments';
    }

    /**
     * @return SchemaParameter[]
     */
    public static function getSchema(): array
    {
        return [
            new SchemaParameter('id', 'id', 'int'),
            new SchemaParameter('post_id', 'postId', 'int'),
            new SchemaParameter('name', 'name', 'string'),
            new SchemaParameter('email', 'email', 'string'),
            new SchemaParameter('content', 'content', 'string'),
            new SchemaParameter('validated', 'validated', 'int'),
            new SchemaParameter('created_at', 'createdAt', 'datetime'),
        ];
    }

    public function __construct()
    {
        $this->validated = 0;
        $this->createdAt = new \DateTime();
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
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     * @return Comment
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Comment
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getValidated(): int
    {
        return $this->validated;
    }

    /**
     * @param int $validated
     * @return Comment
     */
    public function setValidated(int $validated): Comment
    {
        $this->validated = $validated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * @param mixed $other
     * @return Comment
     */
    public function setOther($other)
    {
        $this->other = $other;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}