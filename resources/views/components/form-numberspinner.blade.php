<label for="{{$id}}">@ucfirst($label)
    @if($required) <small class="required" style="color: red"> * </small>
    @endif
</label>
<input type="number" style="width: 100%; {{$style ?? ""}}" step="{{$step ?? "any"}}"
       class="form-control @error($id) is-invalid @enderror {{$class ?? ""}}" @isset($min) min="{{$min}}"
       @endisset @isset($max) max="{{$max}}" @endisset name="{{$id}}" id="{{$id}}"
       value="@if(isset($modelo)){{old($id, $modelo->{$id} ?? $value)}}@else{{old($id)}}@endif"
       placeholder="{{$placeholder ?? ""}}">
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
