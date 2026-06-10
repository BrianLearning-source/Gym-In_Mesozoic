<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleaned = preg_replace('/[\s\-\.\(\)]/', '', $value);

        if (!preg_match('/^(08|\+?62|8)\d{8,12}$/', $cleaned)) {
            $fail('Nomor telepon tidak valid. Gunakan format: 08xxxxxxxxxx, 628xxxxxxxxxx, atau +628xxxxxxxxxx.');
        }
    }
}
