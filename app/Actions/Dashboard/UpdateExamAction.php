<?php

namespace App\Actions\Dashboard;

use App\Models\Exam;
use Illuminate\Support\Str;

class UpdateExamAction
{
    public function execute($id,$title,$description,$duration,$passing_score,$start_at,$end_at,$status)
    {
        return Exam::where('id',$id)->update([
            'title' => $title,
            'description' => $description,
            'passing_score' => $passing_score,
            'duration' => $duration,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'status' => $status,
            'slug' => Str::slug($title),
            'created_by' => auth()->id(),
        ]);
    }
}
