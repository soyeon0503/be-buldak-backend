<?php

namespace App\Entities;

class SideMenuEntity
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $image_path,
        public string $description,
        public string $created_at = '',
        public string $updated_at = ''
    ) {}
}
