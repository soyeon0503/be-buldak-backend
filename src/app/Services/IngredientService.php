<?php
namespace App\Services;

use App\Entities\IngredientEntity;
use App\Repositories\IngredientRepository;
use Illuminate\Support\Facades\Hash;

class IngredientService
{
    public function __construct(private IngredientRepository $ingredientRepository) {}

    public function index(): array
    {
        $ingredient = $this->ingredientRepository->all();
        return array_map(fn($entity) => $this->toEntity($entity), $ingredient);
    }
    
    public function register(array $data): IngredientEntity
    {
        $ingredient = $this->ingredientRepository->create($data);

        return $this->toEntity($ingredient);
    }

    public function update(int $id, array $data): IngredientEntity
    {
        $ingredient = $this->ingredientRepository->update($id, $data);
        return $this->toEntity($ingredient);
    }

    public function show(int $id): IngredientEntity
    {
        $ingredient = $this->ingredientRepository->find($id);
        return $this->toEntity($ingredient);
    }

    public function delete(int $id): void
    {
        $this->ingredientRepository->delete($id);
    }

    private function toEntity($ingredient): IngredientEntity
    {
        return new IngredientEntity(
            id: $ingredient["id"],
            title: $ingredient["title"],
            description: $ingredient["description"] ?? null,
            created_at: $ingredient["created_at"] ?? '',
            updated_at: $ingredient["updated_at"] ?? ''
        );
    }
}