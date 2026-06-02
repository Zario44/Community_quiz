<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class QuestionService
{
    public function saveQuestion(array $data, ?int $questionId = null, int $userId): Question
    {
        return DB::transaction(function () use ($data, $questionId, $userId) {
            
            $question = Question::updateOrCreate(
                ['id' => $questionId],
                [
                    'tag'           => $data['tag'],
                    'question_text' => $data['question_text'],
                    'user_id'       => $userId,
                ]
            );

            $question->answers()->delete();

            foreach ($data['answers'] as $index => $text) {
                $question->answers()->create([
                    'answer_text' => $text,
                    'is_correct'  => ($data['correct_answer'] == $index),
                ]);
            }

            return $question;
        });
    }

    public function deleteQuestion(int $questionId, int $userId): bool
    {
        $question = Question::find($questionId);
        $user = User::find($userId);
        if ($question && ($question->user_id === $userId || $user->is_admin)) {
            return $question->delete(); // Renvoie true si supprimé
        }

        return false; 
    }
} 