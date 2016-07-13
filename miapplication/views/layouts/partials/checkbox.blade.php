<!-- resources/views/form/checkbox.blade.php -->
<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::checkbox(
            $name,
            isset($value) ? $value : 1,
            isset($checked) ? $checked : false
            ) !!}
            {{ $label }}
        </label>
    </div>
</div>

<!-- resources/views/form/radio.blade.php -->
<div class="form-group">
    <div class="radio">
        <label>
            {!! Form::radio(
            $name,
            $value,
            isset($checked) ? $checked : false
            ) !!}
            {{ $label }}
        </label>
    </div>
</div>




<!-- Basic usage -->
@include('form.checkbox', [
'name' => 'remember_me',
'label' => 'Remember Me'
])

@include('form.radio', [
'name' => 'size',
'value' => 'S',
'label' => 'Small'
])
@include('form.radio', [
'name' => 'size',
'value' => 'M',
'label' => 'Medium'
])
@include('form.radio', [
'name' => 'size',
'value' => 'L',
'label' => 'Large'
])