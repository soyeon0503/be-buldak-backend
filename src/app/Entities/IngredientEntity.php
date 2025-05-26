<?php

namespace App\Entities;

class IngredientEntity
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public string $created_at = '',
        public string $updated_at = ''
    ) {}
}
