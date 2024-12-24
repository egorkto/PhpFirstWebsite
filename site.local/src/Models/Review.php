<?php

namespace App\Models;

use App\Kernel\Auth\User;

class Review
{
    public function __construct(
        private int $id,
        private string $rating,
        private string $comment,
        private string $createdAt,
        private User $user,
    ) {}

    public function id()
    {
        return $this->id;
    }

    public function rating()
    {
        return $this->rating;
    }

    public function comment()
    {
        return $this->comment;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

    public function user()
    {
        return $this->user;
    }
}
