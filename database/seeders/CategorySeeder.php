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
        foreach (['Fiction', 'Non-Fiction', 'Action', 'History'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
