<div class="form-group">
    {!! form_label(isset($label) ? $label : null, $name) !!}
     
    {!! form_input( [
                    'type' => isset($type) ? $type : 'text',
                    'name' => $name,
                    'id'   => isset($id) ? $id : $name,
                    'value' => isset($value) ? $value : null,
                    'class' => 'form-control',
                    'placeholder' => isset($value) ? $value : $name                        
        ]) !!}
    
    
</div>
<div class="form-group">
    <label for="description">Description : </label>
    <input class="form-control" type="text" name="description">
</div>