<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LoopRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value) {
            $category = Category::find($value);
            $id = $category->id;
            $res = $category->notInTheParentaSeries($id);

            if ($res) {

                $fail("The category you have chosen is one of the children of this category");
            }
        }
    }
}
