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

    public function register(IngredientRequest $request): IngredientResponse
    {
        $ingredientEntity = $this->ingredientService->register($request->validated());
        return new IngredientResponse($ingredientEntity);
    }

    public function update(IngredientRequest $request, int $id): IngredientResponse
    {
        $ingredientEntity = $this->ingredientService->update($id, $request->validated());
        return new IngredientResponse($ingredientEntity);
    }

    public function index()
    {
        $ingredientEntities = $this->ingredientService->index();

        return response()->json([
            'data' => $ingredientEntities,
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
