<label for="{{$id}}">@ucfirst($label)
    @if($required) <small class="required" style="color: red"> * </small>
    @endif
</label>
<textarea class="textarea form-control @error($id) is-invalid @enderror {{$class ?? ""}}"
          style="width: 100%; {{$style ?? ""}}" name="{{$id}}" id="{{$id}}" rows="{{$rows ?? "3"}}"
          placeholder="@if(isset($placeholder)) {{ $placeholder }} @else {{ ucfirst($label) }} @endif"
          @if(isset($disabled))disabled="{{$disabled}}"@endif> {{$value}}
    {{--@if(isset($modelo)){{old($id, $modelo->{$id} ?? $value)}}@else{{old($id)}}@endif--}}
</textarea>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
