<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Services\QuestionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class saveQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_create_question()
    {
        $user = User::factory()->create();

        $tag = 'histoire';

        $question_text = 'Qui a découvert l\'Amérique ?';

        $answers = [
            'Christophe Colomb',
            'Vasco de Gama',
            'Ferdinand Magellan',
            'Marco Polo'
        ];

        $correct_answer = 0;

        $data = [
            'tag' => $tag,
            'question_text' => $question_text,
            'answers' => $answers,
            'correct_answer' => $correct_answer
        ];

        $test = new QuestionService();
        $results = $test->saveQuestion($data, null, $user->id);

        $this->assertEquals($tag, $results->tag);
        $this->assertEquals($question_text, $results->question_text);
        $this->assertNotNull($results->user_id);

        $this->assertDatabaseHas('questions', [
            'question_text' => 'Qui a découvert l\'Amérique ?',
            'user_id' => $user->id,
            'tag' => 'histoire'
        ]);

        $this->assertDatabaseCount('answers', 4);

        $this->assertDatabaseHas('answers', [
            'question_id' => $results->id,
            'answer_text' => 'Christophe Colomb',
            'is_correct' => true
        ]);
  
    }
}
