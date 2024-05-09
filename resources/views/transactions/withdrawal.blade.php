<form action="{{ route('withdrawal.process') }}" method="post">
    @csrf
    <input type="hidden" name="account_id" value="{{ $account->id }}">
    <label for="amount">Enter withdrawal amount:</label>
    <input type="number" name="amount" id="amount" required>
    <button type="submit">Withdraw</button>
</form>
