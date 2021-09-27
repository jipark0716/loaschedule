<?php
$on['change'] = $on['change'] ?? '';
$default = $default ?? '전체';
?>

<div class="row">
    <div class="col-md-3">
        <label>{{ $label }}</label>
    </div>
    <div class="col-md-9">
        <select onchange="{{ $on['change'] }}" label="{{ $label }}" class="form-select {{ $class }}" name="{{ $name }}">
            <option value="">{{ $default }}</option>
            @foreach ($options as $val => $text)
                @isset ($optionGroup)
                    <optgroup label="{{ $text }}">
                        @foreach ($optionSub[$val] as $subVal => $subText)
                            <option value="{{ $val }}-{{ $subText }}">{{ $subText }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $val }}">{{ $text }}</option>
                @endisset
            @endforeach
        </select>
    </div>
</div>
