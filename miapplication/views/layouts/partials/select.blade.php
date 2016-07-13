<!-- resources/views/form/select.blade.php -->
<div class="form-group">
    {!! Form::label($name, isset($label) ? $label : null, ['class' => 'control-label']) !!}
    {!! Form::select(
    $name, 
    $values, 
    isset($value) ? $value : null,
    ['class' => 'form-control']
    ) !!}
</div>


<!-- Basic usage -->
@include('form.select', [
'name' => 'size', 
'values' => ['' => '', 'S' => 'Small', 'M' => 'Medium', 'L' => 'Large']
])