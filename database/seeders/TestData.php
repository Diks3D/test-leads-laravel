<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TestData extends Seeder
{
    /**
     * Seed the application's test data to DB. (Not work on production!)
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test Developer',
            'email' => 'dev@test-leads.su',
            'password' => 'developer',
        ]);

        $category1 = Category::create([
            'user_id' => $user->id,
            'name' => 'Test category 1',
        ]);

        $category2 = Category::create([
            'user_id' => $user->id,
            'name' => 'Test category 2',
        ]);

        for($i = 1; $i <= 10; $i++){
            $rand = rand(0, 2);

            $categoryId = match($rand){
                0 => null,
                1 => $category1->id,
                2 => $category2->id,
            };

            Task::create([
                'user_id' => $user->id,
                'category_id' => $categoryId,
                'title' => fake()->title(),
                'content' => 'I want a new name like ' . fake()->name,
            ]);
        }
    }
}
