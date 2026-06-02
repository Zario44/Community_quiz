<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Services\QuestionService; 

class UserQuestions extends Component
{
    public function deleteQuestion($id, QuestionService $service)
    {
        // On lui passe l'ID de la question et l'ID de celui qui veut supprimer
        $deleted = $service->deleteQuestion($id, auth()->id());
    }

    public function render()
    {
        return view('user.questions', [
            'questions' => Question::where('user_id', auth()->id())
                            ->latest() // ordronner par date décroissante
                            ->paginate(5), // pagination de 5 par page
            'userName' => auth()->user()->name, 
        ]);
    }
}