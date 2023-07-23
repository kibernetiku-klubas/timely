<?php

namespace App\Http\Requests;

use App\Models\Date;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDate extends FormRequest
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
        $meetingId = $this->input('meeting_id');
        $existingDatesCount = Date::where('meeting_id', $meetingId)->count();

        return [
            'new_time' => [
                'required',
                'unique:dates,date_and_time',
                function ($attribute, $value, $fail) use ($existingDatesCount) {
                    if ($existingDatesCount >= 20) {
                        $fail('The maximum number of dates (20) has been reached for this meeting.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'new_time.unique' => 'The selected date already exists for this meeting.',
            'new_time.required' => 'Please select a date and time.',
        ];
    }
}
