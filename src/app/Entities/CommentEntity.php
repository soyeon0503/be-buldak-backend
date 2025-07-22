<?php

namespace App\Entities;

class CommentEntity
{
    public function __construct(
        public int $id,
        public string $context,
        public int $score,
        public int $recipeId,
        public int $userId,
    ) {}
}
