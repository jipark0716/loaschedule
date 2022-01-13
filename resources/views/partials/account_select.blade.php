<label for="content-id" class="form-label">계정</label>
<select class="selectpicker form-control" id="account_id" name="account_id" onchange="selectAccount($(this).val())">
    <option value=""></option>
    @foreach ($accounts as $account)
        <option value="{{ $account->getKey() }}">{{ $account->main_character }}</option>
    @endforeach
</select>
