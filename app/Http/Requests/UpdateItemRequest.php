<?php

namespace App\Http\Requests;

use App\Rules\ItemMixedCategoryRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', Rule::unique('items')->ignore(request()->item)],
            'category_id' => ['required', 'exists:items,id', new ItemMixedCategoryRule],
            'bounce' => 'nullable|numeric|gt:0',
        ];
    }
}
