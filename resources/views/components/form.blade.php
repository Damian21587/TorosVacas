<form @if (isset($id)) id="{{$id}}" name="{{$id}}" @endif role="form" method="{{ $method ?? 'post' }}"
      action="{{ $action ?? ''}}"
      class="{{ $class ?? ''}}"
      style="{{$style ?? ''}}"
      @if (isset($slotForm)) @endif
      @if (isset($enctype)) enctype="multipart/form-data" @endif>

    @if ($method != 'get')
        @csrf
    @endif
    @if (isset($api))
        @if (in_array(strtolower($api), ['put', 'patch', 'delete']))
            @method($api)
        @endif
    @endif
    {{ $slot }}
</form>
