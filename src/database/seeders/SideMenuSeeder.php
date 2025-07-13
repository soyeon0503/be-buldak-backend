<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SideMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('side_menus')->insert([
           [
            'id' => 1,
            'title' => '콘치즈',
            'image_path' => 'side_dishes/con_cheese.png',
            'description' => '달콤한 콘과 고소한 치즈의 조화',
           ],
           [
            'id' => 2,
            'title' => '타코야끼',
            'image_path' => 'side_dishes/tacoyaki.png',
            'description' => '바삭한 겉과 부드러운 속이 매력적인 일본식 간식',
           ],
           [
            'id' => 3,
            'title' => '떡볶이',
            'image_path' => 'side_dishes/tteokbokki.png',
            'description' => '매콤달콤한 소스에 쫄깃한 떡의 조화',
           ],
           [
            'id' => 4,
            'title' => '순대',
            'image_path' => 'side_dishes/sundae.png',
            'description' => '쫄깃한 순대와 고소한 맛이 일품인 한국 전통 간식',
           ]
        ]);
    }
}