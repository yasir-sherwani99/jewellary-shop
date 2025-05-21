<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Auth::check()) {
            if(!Hash::check($value, Auth::user()->password)) { 
                $fail('The password does not match with old password.');
            }
        }

        if(Auth::guard('admin')->check()) {
            if(!Hash::check($value, Auth::guard('admin')->user()->password)) { 
                $fail('The password does not match with old password.');
            }
        }
    }
}
