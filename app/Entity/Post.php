<?php

namespace App\Entity;

use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;
use Framework\Helpers\TextHelper;

class Post extends AbstractEntity
{

    private $id;
    private $title;
    private $short_content;
    private $content;
    private $slug;
    private $updated_at;

    public $other;

    public static function getTableName(): string
    {
        return 'posts';
    }

    /**
     * @return SchemaParameter[]
     */
    public static function getSchema(): array
    {
        return [
            new SchemaParameter('id', 'id', 'int'),
            new SchemaParameter('title', 'title', 'string'),
            new SchemaParameter('short_content', 'short_content', 'string'),
            new SchemaParameter('content', 'content', 'string'),
            new SchemaParameter('slug', 'slug', 'string'),
            new SchemaParameter('updated_at', 'updated_at', 'datetime'),
        ];
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     * @return  self
     */
    public function setId(int $id): Post
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     * @return  self
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;

        $this->slug = TextHelper::slug($title);

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getShort_content()
    {
        return $this->short_content;
    }

    /**
     * Set the value of content
     *
     * @param string $short_content
     * @return  self
     */
    public function setShort_content(string $short_content): Post
    {
        $this->short_content = $short_content;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     * @return  self
     */
    public function setContent(string $content): Post
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @param string $slug
     * @return  self
     */
    public function setSlug(string $slug): Post
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param \DateTime|string $updated_at
     * @return  self
     */
    public function setUpdated_at($updated_at): Post
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}