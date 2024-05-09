<form action="{{ route('deposit.process') }}" method="post">
    @csrf
    <input type="hidden" name="account_id" value="{{ $account->id }}">
    <label for="amount">Enter deposit amount:</label>
    <input type="number" name="amount" id="amount" required>
    <button type="submit">Deposit</button>
</form>
