<form action="{{ route('transfer.process') }}" method="post">
    @csrf
    <label for="source_account_id">Select source account:</label>
    <select name="source_account_id" id="source_account_id">
        @foreach($accounts as $account)
            <option value="{{ $account->id }}">{{ $account->account_type }}</option>
        @endforeach
    </select>
    <label for="destination_account_id">Select destination account:</label>
    <select name="destination_account_id" id="destination_account_id">
        @foreach($accounts as $account)
            <option value="{{ $account->id }}">{{ $account->account_type }}</option>
        @endforeach
    </select>
    <label for="amount">Enter transfer amount:</label>
    <input type="number" name="amount" id="amount" required>
    <button type="submit">Transfer</button>
</form>
