<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
use App\Models\Question;
use App\Models\Answer;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,     
            QuestionSeeder::class, 
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(5)
        ->has(
            Question::factory()->count(5)
                ->has(
                    Answer::factory()->count(3)     
                        ->has(Answer::factory()->state(['is_correct' => true]))))
                        ->create();

    }
}