<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fiction = Category::where('name', 'Fiction')->first();
        $action = Category::where('name', 'Action')->first();

        Book::firstOrCreate(['title' => 'Coraline'], ['author' => 'Neil Gaiman', 'stock' => 5, 'category_id' => $fiction->id]);
        Book::firstOrCreate(['title' => 'The Little Prince'], ['author' => 'Antoine de Saint-Exupery', 'stock' => 12, 'category_id' => $fiction->id]);
        Book::firstOrCreate(['title' => 'The Maze Runner'], ['author' => 'James Dashner', 'stock' => 3, 'category_id' => $action->id]);
    }
}
