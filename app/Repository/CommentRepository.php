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

    static function getMaxElements(): int
    {
        return (int)self::$pagination['maxElements'];
    }

}