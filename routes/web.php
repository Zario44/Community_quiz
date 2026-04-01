<?php

use Illuminate\Support\Facades\Route;
use App\Models\Question;
use App\Livewire\UserQuestions;
use App\Livewire\FormQuestion;
use App\Http\Controllers\QuizController;
use App\Livewire\GenerateQuiz;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\QuestionController;
use App\Livewire\AdminManageQuestion;
use App\Http\Controllers\Dashboard;
use App\Livewire\Ticket;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [Dashboard::class, 'index'])
->name('dashboard');

Route::get('questions/form', FormQuestion::class)
->name('questions-form');


Route::get('questions/confirm/{id}', function ($id) {
    
    // On cherche manuellement
    $question = Question::find($id);

    // Si on ne trouve pas, on gère l'erreur nous-mêmes
    if (!$question) {
        return view('questions.confirm_error', ['message' => 'Question non trouvée']);
    }
    return view('questions.confirm', ['question' => $question]);
})
->name('confirmQuestions');


Route::get('user/questions', UserQuestions::class)
->name('user.questions');

Route::get('quiz', QuizController::class . '@index')
->name('quiz');

Route::get('quiz/play', GenerateQuiz::class)
->name('quiz.play');

Route::get('ticket/question', Ticket::class)
->name('ticket.question');

Route::middleware([IsAdmin::class])
->prefix('admin')
->name('admin.')
->group(function () {  // Protection des routes admin
    Route::get('questions', AdminManageQuestion::class)->name('questions');
});

require __DIR__.'/settings.php';
