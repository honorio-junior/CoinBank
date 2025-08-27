<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

use App\Models\Extracts;

class TransferObserver
{
    public function generateExtract(int $origin, int $destination, $balance, $newBalance): void
    {
        Extracts::create([
            'origin' => $origin,
            'destination' => $destination,
            'balance' => $balance,
            'newBalance' => $newBalance,
        ]);
    }
}
