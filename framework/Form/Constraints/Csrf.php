<?php

namespace Framework\Form\Constraints;

class Csrf extends AbstractConstraint
{
    public function __construct($errorMessage = 'Le token csrf n\'est pas valide')
    {
        parent::__construct($errorMessage);
    }

    public function isValid($value): bool
    {
        $sessionCsrf = $_SESSION['_csrf_token'] ?? null;

        if ($sessionCsrf === null) {
            return false;
        }

        if ($sessionCsrf['token'] !== $value) {
            return false;
        }

        $createdAt = $sessionCsrf['createdAt'];
        if (!($createdAt instanceof \DateTimeInterface)) {
            return false;
        }

        $now = new \DateTime();
        $timeInSeconds = $now->getTimestamp() - $createdAt->getTimestamp();

        if ($timeInSeconds > 10 * 60) {
            return false;
        }

        return true;
    }
}
