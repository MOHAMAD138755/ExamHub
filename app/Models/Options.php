<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $fillable = [
        'id','question_id','is_correct','option_text'
    ];
}
