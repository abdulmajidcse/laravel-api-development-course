<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'HTML',
            'slug' => 'html'
        ]);

        Category::create([
            'name' => 'CSS',
            'slug' => 'css'
        ]);

        Category::create([
            'name' => 'JS',
            'slug' => 'js'
        ]);
    }
}
