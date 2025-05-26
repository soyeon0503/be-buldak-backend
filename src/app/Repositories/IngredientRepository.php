<?php

namespace App\Repositories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IngredientRepository
{

    public function all(): array
    {
        return Ingredient::all()->toArray();
    }
    
    public function create(array $data): Ingredient
    {
        return Ingredient::create($data);
    }

    public function update(int $id, array $data): Ingredient
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($data);
        return $ingredient;
    }

    public function find(int $id): Ingredient
    {
        return Ingredient::findOrFail($id);
    }

    public function delete(int $id): void
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
    }
}