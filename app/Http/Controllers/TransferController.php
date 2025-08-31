<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Services\TransferService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{

    public function __construct(
        private TransferService $transferService
    ){
    }

    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|integer|exists:accounts,code',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            $this->transferService->handleTransfer(Auth::user()->account, $validated['code'], $validated['amount']);
            return redirect()->back()->with('success', 'Transfer completed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
