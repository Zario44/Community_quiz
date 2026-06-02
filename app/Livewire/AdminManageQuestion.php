<?php

// app/Livewire/MesQuestions.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\User; 
use Livewire\WithPagination;
use App\Services\QuestionService;

class AdminManageQuestion extends Component
{
    use WithPagination;
    public function deleteQuestion($id, QuestionService $service)
    {
        $deleted = $service->deleteQuestion($id); // Suppression de la question via le service
    }

    public function render()
    {
        return view('user.questions', [
            // with('user') charge les données de l'auteur pour chaque question
            'questions' => Question::with('user')->latest()->paginate(5),
        ]);
    }


}