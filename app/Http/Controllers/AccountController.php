<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;


class AccountController extends Controller
{
    public function create()
    {
        return view('accounts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'account_type' => 'required|string',
        ]);

        $user = auth()->user();
        $user->accounts()->create($request->only('account_type'));

        return redirect()->route('dashboard')->with('success', 'Account created successfully.');
    }
    public function index()
    {
        $user = auth()->user();
        $accounts = $user->accounts()->get();
        $accountId = 1; 
        return view('accounts.index', compact('accounts', 'accountId'));
    }
}
