<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinimumTeamMember implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validMembers = array_filter($value, function ($member) {
            return !empty($member['member']) && !empty($member['card']);
        });

        if (count($validMembers) < 1) {
            $fail('Harus ada setidaknya satu anggota teamm yang valid dengan nama dan kartu.');
        }
    }
}
