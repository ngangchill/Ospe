<div class="form-group">
{!! form_textarea($name, 
isset($value) ? $value : '', ['class' =>isset($class)? $class.' form-control' :' form-control', 'placeholder' => isset($placeholder)? $placeholder : $name, 'row' => isset($row)? $row : 4] ) !!}
</div>