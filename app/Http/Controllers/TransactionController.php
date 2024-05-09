<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;



class TransactionController extends Controller
{
    public function index(Account $account)
    {
        $transactions = $account->transactions()->latest()->get();

        return view('transactions.index', compact('transactions', 'account'));
    }
    public function showDepositForm($accountId)
    {
        $user = auth()->user();
        $account = $user->accounts()->find($accountId);
        return view('transactions.deposit', compact('account'));
    }
    public function processDeposit(Request $request)
    {
        $user = auth()->user();
        $account = $user->accounts()->find($request->account_id);
    
        // Ensure that the account exists
        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }
    
        // Increment the account balance
        $account->increment('balance', $request->amount);
    
        // Create a new transaction record
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->account_id = $account->id; // Assign the account_id
        $transaction->amount = $request->amount;
        $transaction->type = 'deposit';
        $transaction->description = 'Deposit transaction';
        $transaction->save();
    
        return redirect()->route('transactions.index', ['account' => $account->id])->with('success', 'Deposit successful!');
    }
    
    public function showWithdrawalForm($accountId)
    {
        $user = auth()->user();
        $account = $user->accounts()->find($accountId);
        return view('transactions.withdrawal', compact('account'));
    }
    
    public function processWithdrawal(Request $request)
    {
        $user = auth()->user();
        $account_id = $request->account_id;
        $account = $user->accounts()->find($account_id);
    
        // Ensure that the account exists
        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }
    
        // Check if the account has sufficient balance
        if ($account->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance!');
        }
    
        // Decrement the account balance
        $account->decrement('balance', $request->amount);
    
        // Create a new transaction record with the correct 'account_id'
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->account_id = $account_id; // Assign the account_id
        $transaction->amount = $request->amount;
        $transaction->type = 'withdrawal';
        $transaction->description = 'Withdrawal transaction';
        $transaction->save();
    
        return redirect()->route('transactions.index', ['account' => $account_id])->with('success', 'Withdrawal successful!');
    }
    
    
    public function showTransferForm()
{
    $user = auth()->user();
    $accounts = $user->accounts()->get();
    return view('transactions.transfer', compact('accounts'));
}

public function processTransfer(Request $request)
{
    $user = auth()->user();
    $sourceAccount = $user->accounts()->find($request->source_account_id);
    $destinationAccount = Account::findOrFail($request->destination_account_id);

    // Ensure that the source account exists
    if (!$sourceAccount) {
        return redirect()->back()->with('error', 'Source account not found.');
    }

    // Ensure that the destination account exists
    if (!$destinationAccount) {
        return redirect()->back()->with('error', 'Destination account not found.');
    }

    // Check if the source account has sufficient balance for transfer
    if ($sourceAccount->balance < $request->amount) {
        return redirect()->back()->with('error', 'Insufficient balance for transfer.');
    }

    // Decrement the source account balance
    $sourceAccount->decrement('balance', $request->amount);

    // Increment the destination account balance
    $destinationAccount->increment('balance', $request->amount);

    // Create a new transaction record with the source account's ID
    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->account_id = $sourceAccount->id;
    $transaction->amount = $request->amount;
    $transaction->type = 'transfer';
    $transaction->description = 'Transfer transaction to ' . $destinationAccount->account_type;
    $transaction->save();

    return redirect()->route('transactions.index', ['account' => $sourceAccount->id])->with('success', 'Transfer successful!');
}

public function showTransactionHistory($accountId)
{
    $user = auth()->user();
    $account = $user->accounts()->find($accountId);
    $transactions = $account->transactions()->latest()->get();

    return view('transactions.history', compact('account', 'transactions'));
}

}
