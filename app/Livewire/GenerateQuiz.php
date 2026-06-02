<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Score;
use App\Services\ScoreService;
use App\Repositories\ScoreRepository;

class GenerateQuiz extends Component
{
    public $questions = [];
    public $currentIndex = 0;
    
    public $quizId; 

    public $localScore = 0;

    public function mount(ScoreRepository $scoreRepository) 
    {
        $newScore = $scoreRepository->createScore(auth()->id());
        $this->quizId = $newScore->id;
        
        $this->questions = Question::with('answers')
            ->inRandomOrder()
            ->limit(10)
            ->get();
    }

    public function selectAnswer(ScoreService $scoreService, $answerId)
    {
        $scoreEntry = Score::find($this->quizId);

        if ($scoreEntry) {
            $isCorrect = $scoreService->scoreUpdate($answerId, $scoreEntry);
            
            if ($isCorrect) {
                $this->localScore++;
            }
        }
        $this->currentIndex++;
    }

    public function ticketQuestion(){
        $currentQuestion = $this->questions[$this->currentIndex]->id;
        return redirect()->route('ticket.question', [
            'questionId' => $currentQuestion
        ]); 
    }

    public function render()
    {
        return view('quiz.play', [
            'finalScore' => $this->localScore 
        ]);
    }
}