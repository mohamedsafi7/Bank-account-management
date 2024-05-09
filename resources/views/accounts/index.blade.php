@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #007bff; color: #fff;">User Accounts</div>

                    <div class="card-body">
                        <ul>
                            @foreach($accounts as $account)
                                <li>{{ $account->account_type }} - Balance: ${{ $account->balance }}</li>
                                <a href="{{ route('transactions.index', ['account' => $account->id]) }}" style="color: #007bff;">View Transactions</a>
                                <!-- Link to view account details -->
                                <div><a href="{{ route('dashboard') }}" style="color: #007bff;">View Accounts</a></div>
                                <div><a href="{{ route('accounts.create') }}" style="color: #007bff;">Create Account</a></div>
                                <div><a href="{{ route('deposit.form', ['account' => $account->id]) }}" style="color: #007bff;">Deposit to Account</a></div>
                                <div><a href="{{ route('withdrawal.form', ['account' => $account->id]) }}" style="color: #007bff;">Withdraw from Account</a></div>
                                <div><a href="{{ route('transfer.form', ['account' => $account->id]) }}" style="color: #007bff;">Transfer from Account</a></div>

                                <!-- Link to view transaction history for a specific account -->
                                <a href="{{ route('transactions.history', ['account' => $account->id]) }}" style="color: #007bff;">View Transaction History</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
