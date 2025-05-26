<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Ingredient\IngredientRequest;
use App\Http\Responses\IngredientResponse;
use App\Http\Controllers\Controller;
use App\Services\IngredientService;
use Illuminate\Http\Response;

class IngredientController extends Controller
{
    public function __construct(private IngredientService $ingredientService) {}

    public function register(IngredientRequest $request): In
    {
        $ingredientEntity = $this->ingredientService->register($request->validated());
        return new UserResponse($ingredientEntity);
    }

    public function update(IngredientRequest $request, int $id): UserResponse
    {
        $ingredientEntity = $this->ingredientService->update($id, $request->validated());
        return new UserResponse($ingredientEntity);
    }

    public function index()
    {
        $ingredientEntities = $this->ingredientService->index();

        return response()->json([
            'ingredients' => array_map(
                fn($entity) => (new IngredientResponse($entity))->toResponse(request())->getData(),
                $ingredientEntities
            ),
        ]);
    }
 
    public function show(int $id): IngredientResponse
    {
        $ingredientEntity = $this->ingredientService->show($id);
        return new IngredientResponse($ingredientEntity);
    }

    public function destroy(int $id): Response
    {
        $this->ingredientService->delete($id);
        return response()->noContent();
    }
}
