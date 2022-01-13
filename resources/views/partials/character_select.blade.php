<label for="content-id" class="form-label">캐릭터</label>
<select class="selectpicker form-control" id="character_id" name="character_id" data-show-subtext="true">
    <option value=""></option>
    @foreach ($characters as $character)
        <option value="{{ $character->getKey() }}" data-subtext="{{ $character->class }}">{{ $character->name }}</option>
    @endforeach
</select>
