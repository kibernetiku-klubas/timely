<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeeting extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $meetingId = $this->route('meeting') ? $this->route('meeting')->id : null;

        return [
            'title' => 'required|string|max:64',
            'description' => 'max:255',
            'location' => 'max:64',
            'timezone' => 'required|string',
            'duration' => 'integer|max:32000|gt:0',
            'delete_after' => 'integer|max:180|gt:0',
            'is1v1' => 'required',
            'voter_invisible' => 'boolean',
            'voting_deadline' => 'integer|max:180|gt:-1',
            'custom_url' => [
                'nullable',
                'max:46',
                'regex:/^[a-z0-9\-]*$/',
                Rule::unique('meetings', 'custom_url')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                })->ignore($meetingId),
            ],        ];
    }
}
