<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{

    public function all(): array
    {
        return User::all()->toArray();
    }
    
    public function create(array $data): User
    {
        $data['tier_id'] = $data['tier_id'] ?? 1;
        
        return User::create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function find(int $id): User
    {
        return User::findOrFail($id);
    }

    public function delete(int $id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}