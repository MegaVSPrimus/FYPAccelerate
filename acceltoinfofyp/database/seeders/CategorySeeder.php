<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{

public function run()
{
    Category::create(['name' => 'Formula 3','slug'=>'formula_3']);
    Category::create(['name' => 'F1 Academy','slug'=>'f1_academy']);
    Category::create(['name' => 'News','slug'=>'news']);
}

}
