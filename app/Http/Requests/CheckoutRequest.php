<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        return [
            'gender' => ['required', 'email'],
            'email' => ['required', 'email'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'street' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'zip' => ['required'],
            'phone' => ['required'],
            'birthday' => ['required'],
            'payment-type' => ['required'],
        ];
    }
}
