<!-- resources/views/form/input.blade.php -->
<div class="form-group">
   
    {!! Form::label($name, isset($label) ? $label : null, ['class' => 'control-label']) !!}
    {!! Form::input(
    isset($type) ? $type : 'text',
    $name,
    isset($value) ? $value : null,
    ['class' => 'form-control']
    ) !!}
</div>
<!-- resources/views/form/input.blade.php -->
<div class="form-group">
    {!! form_label(isset($label) ? $label : null, $name) !!}
    {!! form_input($name, isset($value) ? $value : null, ['class' => 'form-control']) !!}  
</div>


<!-- Basic usage -->
@include('form.input', ['name' => 'first_name'])

<!-- Advanced usage -->
@include('form.input', [
'name' => 'email', 
'type' => 'email',
'label' => 'Email:*',
'value' => 'default@example.com'
])