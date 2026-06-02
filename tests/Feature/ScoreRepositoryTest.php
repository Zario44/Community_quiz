<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Score;
use App\Repositories\ScoreRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreRepositoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_returns_top_10_scores_in_order()
    {

        $user1 = User::factory()->create(['name' => 'Champion']);
        Score::create(['user_id' => $user1->id, 'score' => 100]);

        $user2 = User::factory()->create(['name' => 'Débutant']);
        Score::create(['user_id' => $user2->id, 'score' => 10]);

        $user3 = User::factory()->create(['name' => 'Moyen']);
        Score::create(['user_id' => $user3->id, 'score' => 50]);

        $repository = new ScoreRepository();
        $results = $repository->bestScores();

        $this->assertCount(3, $results);

        $this->assertEquals('Champion', $results[0]->name);
        $this->assertEquals(100, $results[0]->score);

        $this->assertEquals('Moyen', $results[1]->name);
    }
}