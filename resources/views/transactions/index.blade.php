<!-- resources/views/transactions/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transaction History - {{ $account->account_type }}</div>

                    <div class="card-body">
                        <ul>
                            @foreach($transactions as $transaction)
                                <li>{{ $transaction->type }} - Amount: ${{ $transaction->amount }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
