<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['electric vehicle', 'vehicle', 'electronic', 'laptop', 'monitor', 'keyboard', 'mouse', 'table', 'stand', 'speaker'];

        foreach ($categories as $category){
            Category::create([
                'name'  => $category,
                'slug' => Str::slug($category),
                'user_id' => rand(1,2),
            ]);
        };
    }
}
