<?php

namespace App\Http\Requests;

use App\Rules\MainTruckOverlapRule;
use App\Rules\SubUnitOverlapRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubUnitRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            'main_truck' => ['required', 'integer', Rule::exists('trucks', 'id'), new MainTruckOverlapRule($this->start_date, $this->end_date)],
            'sub_unit' => ['required', 'integer', Rule::exists('trucks', 'id'), 'different:main_truck', new SubUnitOverlapRule($this->start_date, $this->end_date0000)],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date']
        ];
    }
}
