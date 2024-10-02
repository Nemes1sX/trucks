<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTruckRequest extends FormRequest
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
        $maxYear = date('Y') + 5;

        return [
            'name' => ['required', 'string', 'min:5', 'max:255', Rule::unique('trucks')->ignore($this->truck)],
            'year' => ['min:1900', 'max:' . $maxYear, 'required', 'integer'],
            'notes' => ['nullable']
        ];
    }
}
