<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags =  collect([
            'Technology', 'Sport', 'Business', 'Travel'
        ]);
        $tags->each(function($c){
            Tag::create([
                'tag' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
