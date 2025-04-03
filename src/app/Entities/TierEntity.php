<?php

namespace App\Entities;

class TierEntity
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public string $imagePath,
    ) {}
}