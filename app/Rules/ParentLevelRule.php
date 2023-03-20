<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ParentLevelRule implements ValidationRule
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
            $countLevel = $category->countLevel();
            $ruleCountLevel = config('rules.count_level_accepted');
            if ($ruleCountLevel < $countLevel) {
                $fail("you can't add new level");
            }
        }
    }
}
