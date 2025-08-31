<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\Extracts;
use Illuminate\Support\Facades\DB;

class TransferService
{

    public function handleTransfer($userAccount, $destinationCode, $amount)
    {
        $destinationAccount = Accounts::where('code', $destinationCode)->firstOrFail();

        if ($destinationAccount->code === $userAccount->code) {
            throw new \Exception('You cannot transfer to your own account.');
        }

        if ($userAccount->status == 0) {
            throw new \Exception('Your account is blocked.');
        }

        if ($destinationAccount->status == 0) {
            throw new \Exception('Destination account is blocked.');
        }

        if ($userAccount->balance < $amount) {
            throw new \Exception('Insufficient balance.');
        }

        DB::transaction(function () use ($userAccount, $destinationAccount, $amount) {
            $userAccount->balance -= $amount;
            $userAccount->save();

            $destinationAccount->balance += $amount;
            $destinationAccount->save();

            $this->generateExtract(
                $userAccount->code,
                $destinationAccount->code,
                $amount,
                $userAccount->balance
            );
        });
    }
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
