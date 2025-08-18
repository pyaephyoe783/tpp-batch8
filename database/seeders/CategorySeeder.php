<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Technology',
            ],
            [
                'id' => 2,
                'name' => 'Health',
            ],
            [
                'id' => 3,
                'name' => 'Lifestyle',
            ],
            [
                'id' => 4,
                'name' => 'Education',
            ],
        ];

        foreach($categories as $category)
        {
            Category::create($category);
        }
    }
}
