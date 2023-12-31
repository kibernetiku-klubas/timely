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
        $action = $this->route()->getActionMethod();

        if ($action === 'finalizeDate') {
            return [];
        }

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
                $fail(__('storeDate.unique'));
            }
        };
    }

    private function ruleMaxDates($existingDatesCount): Closure
    {
        return function ($attribute, $value, $fail) use ($existingDatesCount) {
            if ($existingDatesCount >= 20) {
                $fail(__('storeDate.max'));
            }
        };
    }

    public function messages(): array
    {
        return [
            'new_time.required' => __('storeDate.select'),
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
