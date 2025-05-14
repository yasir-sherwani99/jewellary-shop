<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value >= $this->price) {
                        $fail('The discount price must be less than the regular price.');
                    }
                },
            ],
            'stock_qty' => 'required|numeric|min:1',
            'description' => 'required|string|min:10',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name must be 255 characters or less.',
            'category_id.required' => 'The product category is requried.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',
            'discount_price.numeric' => 'The product discount price must be a number.',
            'discount_price.min' => 'The product discount price cannot be negative.',
            'stock_qty.required' => 'The product stock quantity is required.',
            'stock_qty.min' => 'The product stock quantity must be 1 or greater.',
            'description.required' => 'The product description is required.',
            'description.min' => 'The product description must be 10 characters or greater.',
            'images.required' => 'The product images are required.',
            'images.min' => 'Please upload atleast 1 image',
            'images.*.image' => 'Each file must be an image',
            'images.*.mimes' => 'Only JPEG, PNG, JPG, GIF, and WEBP formats are allowed',
            'images.*.max' => 'Each image must be less than 2MB',
        ];
    }
}
