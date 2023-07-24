<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'voted_by' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
