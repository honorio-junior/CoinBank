<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Services\TransferObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{

    public function __construct(
        private TransferObserver $transferObserver
    ){
    }


    public function transfer(Request $request)
    {
        // Validate
        $request->validate([
            'code' => 'required|integer|exists:accounts,code',
            'amount' => 'required|numeric|min:1',
        ]);

        $userAccount = Auth::user()->account;

        // Check if is blocked
        if ($userAccount->status == 0) {
            return redirect()->back()->with('error', 'Your account is blocked, you cannot make any transactions.');
        }

        // Check if has sufficient balance
        if ($userAccount->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance for this transfer.');
        }

        // Find the destination account
        $destinationAccount = Accounts::where('code', $request->code)->first();

        // The account is of the user
        if ($destinationAccount->code == Auth::user()->account->code) {
            return redirect()->back()->with('error', 'You cannot transfer to your own account.');
        }

        // Check if the destination account is blocked
        if ($destinationAccount->status == 0) {
            return redirect()->back()->with('error', 'The destination account is blocked, transfer cannot be completed.');
        }

        // Transfer
        DB::transaction(function () use ($userAccount, $destinationAccount, $request) {

            // =========================================================================
            // aqui entra usar bibliotecas para transacoes financeiras em php
            // como o MoneyPHP
            // ou ate o laravel Money
            // estou fazendo direto assim por falta de tempo no momento
            // mas pretendo usar o laravel money em padrao de projeto adapter, a escolha da empresa,
            // assim podendo mudar para outro facilmente

            // usuario - balance
            $userAccount->balance -= $request->amount;


            $userAccount->save();

            // destino + balance
            $destinationAccount->balance += $request->amount;
            $destinationAccount->save();
            // =========================================================================

            $origin = $userAccount->code;
            $destination = $destinationAccount->code;
            $balance = $request->amount;
            $newBalance = $userAccount->balance;

            $this->transferObserver->generateExtract($origin, $destination, $balance, $newBalance);

        });

        return redirect()->back()->with('success', 'Transfer completed successfully!');
    }
}
