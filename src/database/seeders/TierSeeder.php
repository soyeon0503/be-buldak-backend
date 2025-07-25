<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tiers')->insert([
            [
                'name' => '1단계',
                'description' => '맵린이~!~!',
                'image_path' => 'tiers/beginner.png',
            ],
            [
                'name' => '2단계',
                'description' => '맵맵맵',
                'image_path' => 'tiers/intermediate.png',
            ],
            [
                'name' => '3단계',
                'description' => '맵부심',
                'image_path' => 'tiers/advanced.png'
            ],
            [
                'name' => '4단계',
                'description' => '맵고수',
                'image_path' => 'tiers/expert.png'
            ],
            [
                'name' => '5단계',
                'description' => '맵신',
                'image_path' => 'tiers/master.png'
            ],
        ]);   
    }
}