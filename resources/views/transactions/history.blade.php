@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transaction History for {{ $account->account_type }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
