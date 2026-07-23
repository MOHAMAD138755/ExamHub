<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:40|unique:exams,title',
            'description' => 'required|string|max:255',
            'passing_score' => 'required|numeric|min:0|max:20',
            'duration' => 'required|numeric|min:1',
            'status' => 'required|in:0,1',
            'start_at' => 'date|after:now',
            'end_at' => 'date|after:start_at',
        ];
    }
}
