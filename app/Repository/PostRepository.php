<?php

namespace App\Repository;

use App\Entity\Post;
use Framework\Database\Repository\AbstractRepository;
use Framework\Helpers\TextHelper;

class PostRepository extends AbstractRepository
{

    static $pagination = [
        'maxElements' => 4
    ];

    protected function getEntity(): string
    {
        return Post::class;
    }

    private function getOffset($pageNumber)
    {
        return ($pageNumber - 1) * self::getMaxElements();
    }

    public function findForHomePage($pageNumber = null)
    {
        $limit = ($pageNumber) ? 'LIMIT :p_offset, :p_limit' : ' LIMIT 3 ';

        $query = "SELECT posts.* FROM posts ORDER BY posts.id DESC {$limit}";

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