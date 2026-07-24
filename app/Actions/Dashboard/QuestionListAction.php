<?php

namespace App\Actions\Dashboard;

use App\Models\Question;

class QuestionListAction
{
    public function execute($exam_id)
    {
        return Question::where('exam_id',$exam_id)->latest()->paginate(5);
    }
}
