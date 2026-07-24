<?php

namespace App\Actions\Dashboard;

use App\Models\Question;

class UpdateQuestionAction
{
    public function execute(
        Question $question,
        string $question_text,
        int $score,
        array $options,
        int $correct_option
    ): void {

        $question->update([
            'question_text' => $question_text,
            'score' => $score,
        ]);

        foreach ($question->options as $index => $option) {

            $option->update([
                'option_text' => $options[$index],
                'is_correct' => $index == $correct_option,
            ]);

        }
    }
}
