<label for="{{$id}}">@ucfirst($label)
       @if($required) <small class="required" style="color: red"> * </small>
       @endif
</label>
<input @isset($pattern) pattern="{{$pattern}}" @endisset type="text" class="form-control @error($id) is-invalid @enderror {{$class ?? ""}}"
       style="width: 100%; {{$style ?? ""}}"
       name="{{$id}}" id="{{$id}}"
       value="{{$value}}"
       {{--minlength="{{$minlength ?? 1}}" maxlength="{{$maxlength ?? 255}}"--}}
       placeholder="{{$placeholder ?? ucfirst($label)}}">
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
@isset ($help)
    <div>
        <span class="help-block form-text text-muted text-small">{{ $help }}</span>
    </div>
@endisset


