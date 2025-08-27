<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

/**
 * Class AccountCodeService.
 */
class AccountCodeService
{
    public function generate(): int
    {
        do {
            $code = mt_rand(1000, 2147483647); // collumn integer code
        } while (User::where('code', $code)->exists());

        return $code;
    }
}
