<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Services\QuestionService;
use App\Livewire\Forms\QuestionForm; 
use Illuminate\Support\Facades\Cache;

class FormQuestion extends Component
{
    public QuestionForm $form; // On utilise le formulaire personnalisé

    public $questionId = null; // On garde juste l'ID à part car il ne fait pas partie du formulaire visible

    public function mount($id = null)
    {
        $finalId = $id ?: request()->query('id'); // on récupère l'ID de l'URL

        if ($finalId) { // Édition de la question
            $question = Question::with('answers')->find($finalId);
            if ($question) {
                $this->questionId = $question->id;
                // On utilise la méthode qu'on a créée pour remplir
                $this->form->setQuestion($question);
            }
        }
    }

    public function saveQuestion(QuestionService $questionService)
    {

        $this->form->validate(); 
        $data = $this->form->all(); 

        $notDoubled = Cache::add('question_submitted_'.auth()->id().'_'.$this->questionId, true, 3); 
        if ($notDoubled) {
            $savedQuestion = $questionService->saveQuestion(
                data: $data,
                questionId: $this->questionId,
                userId: auth()->id()
            );
        } else {
            return; 
        }

        return redirect()->route('confirmQuestions', ['id' => $savedQuestion->id]);
    }

    public function render()
    {
        return view('livewire.question-form');
    }
}