<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receipt;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\SideMenu;
use Illuminate\Support\Str;

class ReceiptSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        $ingredientIds = Ingredient::pluck('id')->toArray();
        $sideMenuIds = SideMenu::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $selectedIngredientIds = collect($ingredientIds)
                ->shuffle()
                ->take(rand(3, 5))
                ->values()
                ->toArray();

            $selectedSideMenuIds = collect($sideMenuIds)
                ->shuffle()
                ->take(rand(2, 4))
                ->values()
                ->toArray();

            Receipt::create([
                'title' => '레시피 ' . Str::random(5),
                'image_path' => 'recipes/sample_' . rand(1, 5) . '.jpg',
                'description' => '이것은 맛있는 레시피입니다. ' . fake()->sentence(),
                'ingredients' => $selectedIngredientIds,
                'steps' => [
                    '재료를 준비한다',
                    '프라이팬에 볶는다',
                    '양념을 넣고 졸인다',
                    '접시에 담는다',
                ],
                'servings' => rand(1, 4),
                'cooking_time' => rand(10, 60),
                'spicy' => rand(1, 5),
                'saved' => rand(0, 100),
                'views' => rand(100, 1000),
                'rate' => rand(1, 5),
                'recommend_side_menus' => $selectedSideMenuIds,
                'writer' => $user->id,
                'comments' => null,
            ]);
        }
    }
}
