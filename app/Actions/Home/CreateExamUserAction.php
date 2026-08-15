<?php

namespace App\Actions\Home;

use App\Models\User;

class CreateExamUserAction
{
    public function execute($exam_id, $user_id)
    {
        return User::findOrFail($user_id)->exams()->attach($exam_id,[
            'score' => null,
        ]);
    }
}
