<?php

namespace App\Repository;

use App\Entity\User;
use Framework\Database\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected function getEntity(): string
    {
        return User::class;
    }
}