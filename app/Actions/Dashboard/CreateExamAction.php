<?php

namespace App\Actions\Dashboard;

use App\Models\Exam;
use Illuminate\Support\Str;

class CreateExamAction
{
    public function execute($title,$description,$duration,$status,$passing_score,$start_at,$end_at)
    {
        return Exam::create([
            'title' => $title,
            'description' => $description,
            'duration' => $duration,
            'status' => $status,
            'passing_score' => $passing_score,
            'slug' => Str::slug($title),
            'created_by' => auth()->id(),
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);
    }
}
