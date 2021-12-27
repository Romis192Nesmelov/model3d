<div class="form-group has-feedback has-feedback-left {{ count($errors) && $errors->has($name) ? "has-error" : '' }} {{ isset($addClass) ? $addClass : '' }}" {!! isset($attrString) ? $attrString : '' !!}>
    @if (isset($label))
        <div class="description input-label">{{ $label }}</div>
    @endif
    <select name="{{ $name }}" class="form-control">
        @if (is_array($values))
            @foreach ($values as $value => $options)
                <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $options }}</option>
            @endforeach
        @else
            @foreach ($values as $value)
                <option value="{{ $value->id }}" {{ (!count($errors) ? $value->id == $selected : $value->id == old($name)) ? 'selected' : '' }}>{{ $name == 'user_id' ? Helper::userCreds($value) : $value->name }}</option>
            @endforeach
        @endif
    </select>
    @include('_input_error_block')
</div>