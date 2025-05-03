<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutProcessRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer,cod',
            'create_account' => 'sometimes|boolean',
            'password' => 'nullable|string|min:6|confirmed',
            // 'password' => [
            //     'required_if:create_account,1',
            //     Rule::when($request->create_account, [
            //         'string',
            //         'min:8',
            //         'confirmed'
            //     ])
            // ],
            'notes' => 'nullable|string|max:2500'
        ];
    }
}
