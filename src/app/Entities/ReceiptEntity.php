<?php

namespace App\Entities;

class ReceiptEntity
{
    public function __construct(
        public  int $id,
        public  string $title,
        public  ?string $image_path,
        public  string $description,
        public  array $ingredients,
        public  array $steps,
        public  int $servings,
        public  int $cooking_time,
        public  int $spicy,
        public  int $saved,
        public  int $views,
        public  int $rate,
        public  array $recommend_side_menus,
        public  int $writer,
        public  ?int $comments,
        public  string $created_at,
        public  string $updated_at
    ) {}
}
