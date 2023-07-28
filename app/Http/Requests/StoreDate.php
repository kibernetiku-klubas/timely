<?php

namespace App\Http\Requests;

use App\Models\Date;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                function ($attribute, $value, $fail) use ($meetingId) {
                    // checks if the date is equal in the same meeting
                    $date = Date::where('meeting_id', $meetingId)->where('date_and_time', $value);
                    if ($this->getMethod() === 'PUT') { // excludes updated date from being checked (for when date is kept as before)
                        $date->where('id', '!=', $this->route('date'));
                    }
                    if ($date->count() > 0) {
                        $fail('The selected date already exists for this meeting.');
                    }
                },
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
            'new_time.required' => 'Please select a date and time.',
        ];
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('error', $validator->errors()->first())
        );
    }
}
