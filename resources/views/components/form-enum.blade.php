<label for="{{$id}}"> @ucfirst($label)
    @if($required)
        <small class="required" style="color: #DA2513"> *</small>
    @endif
</label>
<select class="form-control select2bs4 @error($id) is-invalid @enderror"
        name="{{$id}}" id="{{$id}}">
    <option value="" class="text-muted"> @lang('inifat.lbSeleccionar') </option>
    @foreach($datos as $record)
        <option value="{{$record['value']}}"
                @if(isset($modelo))
                @if($modelo->{$id} == $record['value'])selected="selected"
                @endif
                @else
                @if( old($id) == $record['value'] )  selected="selected" @endif
            @endif>{{$record['value']}}</option>
    @endforeach
</select>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
