<?php

namespace App\Http\Requests;

use App\Rules\LoopRule;
use App\Rules\MixedElementRule;
use App\Rules\ParentLevelRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
            'parent_id' => ['nullable', 'exists:categories,id', new ParentLevelRule, new MixedElementRule, new LoopRule],
            'name' => ['required', 'min:3', Rule::unique('categories')->ignore(request()->category)],
            'bounce' => 'nullable|numeric',
        ];
    }
}
