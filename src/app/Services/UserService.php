<?php

namespace App\Services;

use App\Entities\UserEntity;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    public function index(): array
    {
        $users = $this->userRepository->all();
        return array_map(fn($user) => $this->toEntity($user), $users);
    }
    
    public function register(array $data): UserEntity
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        return $this->toEntity($user);
    }

    public function update(int $id, array $data): UserEntity
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = $this->userRepository->update($id, $data);
        return $this->toEntity($user);
    }

    public function show(int $id): UserEntity
    {
        $user = $this->userRepository->find($id);
        return $this->toEntity($user);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }

    private function toEntity($user): UserEntity
    {
        return new UserEntity(
            id: $user->id,
            email: $user->email,
            name: $user->name,
            birth: $user->birth?->toDateString(),
            tierId: $user->tier_id,
        );
    }
}