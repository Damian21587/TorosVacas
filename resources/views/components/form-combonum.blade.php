<label for="{{$id}}">@ucfirst($label)
    @if($required)
        <small class="required" style="color: red"> * </small>
    @endif
</label>
<select class="form-control select2bs4 @error($id) is-invalid @enderror {{$class ?? ""}}"
        style="width: 100%; {{$style ?? ""}}" name="{{$id}}" id="{{$id}}">
    <option value="" class="text-muted"> @lang('balonmano.lbSeleccionar') </option>
    @while ($min <= $max)
        <option value="{{ $min }}" @if(isset($modelo)) @if( $modelo->{$id} == $min ) selected="selected"
                @endif @else @if( old($id) == $min ) selected="selected" @endif @endif>{{ $min }}</option>
        {{$min += $step}}
    @endwhile
</select>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
