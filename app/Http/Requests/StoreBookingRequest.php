<?php

namespace App\Http\Requests;

use App\Rules\NoDoubleBooking;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            //
            'service_name' => 'required|string|max:255',
            'scheduled_at' => [
                'required',
                'date',
                'after:now',
                new NoDoubleBooking($this->input('service_name')),
                'notes' => 'nullable|string',
                'amount' => 'required|numeric|min:1',
            ]
        ];
    }
}
