<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'passing_score',
        'duration',
        'status',
        'start_at',
        'end_at',
        'created_by',
        'start_at',
        'end_at',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at'   => 'datetime',
            'status'   => 'boolean',
        ];
    }
}
