<?php

namespace App\Repository;

use App\Entity\Comment;
use Framework\Database\Repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{

    static $pagination = [
        'maxElements' => 4
    ];

    protected function getEntity(): string
    {
        return Comment::class;
    }

    private function getOffset($pageNumber)
    {
        return ($pageNumber - 1) * self::getMaxElements();
    }

    public function findAllWithPosts($validated = 1)
    {

        $query = "SELECT posts.slug, posts.title, comments.*
        FROM comments 
        LEFT JOIN posts ON posts.id = comments.post_id
        WHERE comments.validated = :validated
        GROUP BY comments.id 
        ORDER BY comments.created_at DESC";

        $query = $this->db->prepare($query);

        $query->execute(['validated' => $validated]);

        return $this->hydrateEntities($query->fetchAll());

    }

    public function validate($id): bool
    {
        $query = "UPDATE comments SET validated=1 WHERE id=:id";
        $query = $this->db->prepare($query);

        return $query->execute([
            'id' => $id,
        ]);
    }

    static function getMaxElements(): int
    {
        return (int)self::$pagination['maxElements'];
    }

}