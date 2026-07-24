<?php

namespace App\Actions\Dashboard;

use App\Models\Options;
use App\Models\Question;

class CreateQuestionAction
{
    public function execute($question_text,$exam_id,$score,$option_text,$is_correct)
    {
        $question = Question::create([
            'question_text' => $question_text,
            'exam_id' => $exam_id,
            'score' => $score
        ]);

        foreach ($option_text as $index => $option) {
            Options::create([
                'option_text' => $option,
                'question_id' => $question->id,
                'is_correct' =>  $index === $is_correct
            ]);
        }
    }
}
