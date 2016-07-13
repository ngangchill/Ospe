<div class="form-group">
    {!! form_label(isset($label) ? $label : null, $name, ['class' => isset($class)? $class.' form-control': 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
    @if(isset($selected))
        {!! form_dropdown($name, $values, $selected, ['class' => isset($class)? $class.' form-control':'form-control', 'onchange' => isset($onchange)? $onchange: null ]) !!}
    @else
    <select class="{{ isset($class)? $class.' form-control':'form-control'}}" name="{{ $name }}" id="{{ isset($id)? $id : $name}}" {!! isset($extra)? $extra :NULL !!}>
        <option value="" selected="selected" disabled="disabled">Select {{ $name }}</option>
        @foreach($values as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    @endif
    </div>
</div>
