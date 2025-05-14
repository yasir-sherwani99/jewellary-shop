<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RequiredIfNoPreloadedImages implements ValidationRule
{
    protected $preloaded;

    public function __construct($preloaded = null) 
    {
        $this->preloaded = $preloaded;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hasPreloaded = !empty($this->preloaded);
        $hasNewImages = is_array($value) && count(array_filter($value)) > 0;

        if (!$hasPreloaded && !$hasNewImages) {
            $fail('At least one image is required (upload new or keep existing).');
        }
    }
}
