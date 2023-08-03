<?php

namespace App\Http\Requests;

use App\Models\Date;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
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
        $existingDatesCount = $this->getExistingDatesCount($meetingId);

        return [
            'new_time' => [
                'required',
                $this->ruleUniqueDate($meetingId),
                $this->ruleMaxDates($existingDatesCount),
            ],
        ];
    }

    private function getExistingDatesCount($meetingId): int
    {
        return Date::where('meeting_id', $meetingId)->count();
    }

    private function ruleUniqueDate($meetingId): Closure
    {
        return function ($attribute, $value, $fail) use ($meetingId) {
            $date = Date::where('meeting_id', $meetingId)->where('date_and_time', $value);
            if ($this->getMethod() === 'PUT') {
                $date->where('id', '!=', $this->route('date'));
            }
            if ($date->count() > 0) {
                $fail('The selected date already exists for this meeting.');
            }
        };
    }

    private function ruleMaxDates($existingDatesCount): Closure
    {
        return function ($attribute, $value, $fail) use ($existingDatesCount) {
            if ($existingDatesCount >= 20) {
                $fail('The maximum number of dates (20) has been reached for this meeting.');
            }
        };
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
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('error', $validator->errors()->first())
        );
    }
}
