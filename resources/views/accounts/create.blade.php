<!-- resources/views/accounts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Account</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('accounts.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="account_type">Account Type</label>
                                <select name="account_type" id="account_type" class="form-control">
                                    <option value="checking">Checking</option>
                                    <option value="savings">Savings</option>
                                    <!-- Add more account types if needed -->
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
