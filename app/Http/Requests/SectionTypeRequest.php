<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
        ];
    }
}
