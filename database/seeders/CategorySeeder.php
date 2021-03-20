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
        $categories = collect([
            'Technology', 'Sport', 'Business', 'Travel'
        ]);
        $categories->each(function($c){
            Category::create([
                'category' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
