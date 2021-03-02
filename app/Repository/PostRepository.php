<?php

namespace App\Repository;

use App\Entity\Post;
use Framework\Database\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    static $pagination = [
        'maxElements' => 8
    ];

    protected function getEntity(): string
    {
        return Post::class;
    }

    private function getOffset($pageNumber)
    {
        return ($pageNumber - 1) * self::getMaxElements();
    }

    /**
     * @param int $postId
     */
    public function findWithUser(int $postId)
    {
        $query = "SELECT posts.*, posts.title, users.firstname, users.lastname
        FROM posts
        LEFT JOIN users ON posts.user_id = users.id WHERE posts.id = :id";

        $query = $this->db->prepare($query);

        $query->execute(['id' => $postId]);

        return $this->hydrateEntity($query->fetch());
    }

    /**
     * @param int|null $pageNumber
     * @return array|\Framework\Database\Entity\AbstractEntity[]
     */
    public function findForHomePage($pageNumber = null)
    {
        $limit = ($pageNumber) ? 'LIMIT :p_offset, :p_limit' : ' LIMIT 3';

        $query = "SELECT posts.*, posts.title, users.firstname, users.lastname
        FROM posts
        LEFT JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC {$limit}";

        $query = $this->db->prepare($query);

        $query->bindValue(':p_limit', self::getMaxElements(), \PDO::PARAM_INT);
        $query->bindValue(':p_offset', $this->getOffset($pageNumber), \PDO::PARAM_INT);

        $query->execute();

        return $this->hydrateEntities($query->fetchAll());

    }

    static function getMaxElements(): int
    {
        return (int)self::$pagination['maxElements'];
    }

}