<?php

namespace App\Entities;

class UserEntity
{
    public function __construct(
        public int $id,
        public string $email,
        public string $name,
        public ?string $birth,
        public int $tierId
    ) {}
}
