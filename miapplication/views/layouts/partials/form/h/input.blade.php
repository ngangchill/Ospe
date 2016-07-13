@if(isset($horizontal))
<div class="form-group">
    {!! form_label(isset($label) ? $label : null, $name, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! form_input( ['type' => isset($type) ? $type : 'text', 'name' => $name,'id'   => isset($id) ? $id : $name, 'value' => isset($value) ? $value : null, 'class' => isset($class)? $class. ' form-control' : 'form-control', 'placeholder' => isset($value) ? $value : 'Your '.$name]) !!}
    </div>
</div>
@else 
<div class="form-group">
    {!! form_label(isset($label) ? $label : null, $name) !!}
    {!! form_input( ['type' => isset($type) ? $type : 'text', 'name' => $name,'id'   => isset($id) ? $id : $name, 'value' => isset($value) ? $value : null, 'class' => isset($class)? $class : 'form-control', 'placeholder' => isset($value) ? $value : 'Your '.$name]) !!}
</div>
@endif