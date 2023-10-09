<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    public bool $status = false;
    public bool $trending = false;
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
           'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'small_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'original_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'meta_title' => ['required', 'string'],
            'meta_keyword' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
            'image' => ['nullable', 'nullable'],
        ];
    }
}
