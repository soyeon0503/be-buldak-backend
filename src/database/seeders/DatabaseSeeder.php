<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Database\Seeders\TierSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 실행할 seeder들 추가
        $this->call([
            TierSeeder::class,
            SideMenuSeeder::class,
        ]);

        //실행할 factory들 추가
        User::factory(30)->create();
        Ingredient::factory(30)->create();
    }
}
