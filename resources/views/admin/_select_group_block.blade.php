<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ count($errors) && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label))
        <label class="control-label col-md-12 text-semibold">{{ $label }}</label>
    @endif
    <select {{ isset($disabled) && $disabled ? 'disabled' : '' }} name="{{ $name }}" class="form-control">
        @foreach ($groups as $group)
            <optgroup label="{{ $group->name }}">
                @foreach ($group->$children as $item)
                    <option value="{{ $item->id }}" {{ (!count($errors) ? $item->id == $selected : $item->id == old($name)) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @include('_input_error_block')
</div>