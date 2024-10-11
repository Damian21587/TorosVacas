<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input @error($id)is-invalid @enderror{{$class ?? ""}}" name="{{$id}}" id="{{$id}}"@if(isset($value)) value="{{$value}}" @endif @if(old($id)=="on") checked @endif>
    <label class="custom-control-label" for="{{$id}}">@ucfirst($label) @if($required)<small class="required" style="color: red"> * </small>@endif</label>
</div>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
