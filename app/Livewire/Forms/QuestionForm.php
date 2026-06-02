<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;

class QuestionForm extends Form
{
    
    #[Rule('required|string')]
    public $tag = '';

    #[Rule('required|string')]
    public $question_text = '';

    // Pour les tableaux, on valide le tableau lui-même ici
    #[Rule('required|array|size:4')] 
    public $answers = ['', '', '', ''];

    #[Rule('required')]
    public $correct_answer = null;

    // Méthode pour pré-remplir le formulaire lors de l'édition
    public function setQuestion($question)
    {
        $this->tag = $question->tag;
        $this->question_text = $question->question_text;
        
        foreach ($question->answers as $index => $answer) {
            $this->answers[$index] = $answer->answer_text;
            if ($answer->is_correct) {
                $this->correct_answer = $index;
            }
        }
    }
}