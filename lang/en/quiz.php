<?php

return [
    'menu_title' => 'Quiz', 
    
    'form' => [
        'title_add' => 'Add a Question',
        'title_edit' => 'Edit Question',
        'subtitle' => 'Configure your question and define the correct answer.',
        
        'labels' => [
            'tag' => 'Topic / Tag',
            'question' => 'Your Question',
            'answers' => 'Possible Answers (Check the correct one)',
        ],

        'placeholders' => [
            'tag' => 'Ex: History, Cinema...',
            'question' => 'What is the capital of...',
            'answer' => 'Enter the answer...',
        ],
    ],

    'buttons' => [
        'save' => 'Save New Question',
        'update' => 'Update Question',
        'cancel' => 'Cancel and go back to list',
    ],

    'errors' => [
        'no_tag' => 'The topic is required.',
        'no_question' => 'The question is required.',
        'no_correct_answer' => 'Please select the correct answer.',
        'no_full_answers' => 'All answer fields must be filled.',
    ],

    'messages' => [
        'success_created' => 'Question successfully created!',
        'success_updated' => 'Question updated.',
    ],
    
];