<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\Accounts;
use App\Models\User;
use App\Services\AccountCodeService;

class HomeController extends Controller
{

    public function __construct(
        private AccountCodeService $accountCodeService
    ){
    }

    public function showView()
    {
        $account = Auth::user()->account;

        // Paginação de 10 por página
        $extracts = $account->extracts()->orderBy('created_at', 'desc')->paginate(5);

        return view('home', compact('extracts'));
    }

    public function newAccount(): RedirectResponse
    {
        if (Auth::user()->account != null) {
            return redirect()->back()->with('account-exists', 'You already have a bank account.');
        }

        Accounts::create(
            [
                'user_id' => Auth::id(),
                'code' => $this->accountCodeService->generate()
            ]
        );

        return redirect()->back()->with('account-created', 'Account created successfully.');
    }
}
