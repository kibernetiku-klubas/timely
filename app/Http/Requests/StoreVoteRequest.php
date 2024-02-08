<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'voted_by' => 'max:50',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
