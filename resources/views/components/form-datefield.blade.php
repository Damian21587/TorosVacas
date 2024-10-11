<label for="{{$id}}">@ucfirst($label)
    @if($required) <small class="required" style="color: red"> * </small>
    @endif
</label>
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
    </div>
<input type="date" class="form-control @error($id) is-invalid @enderror {{$class ?? ""}}"
      {{-- style="width: 100%; {{$style ?? ""}}"--}} name="{{$id}}" id="{{$id}}"
       @isset($min) min="{{ $min }}" @endisset @isset($max) max="{{ $max }}" @endisset
       data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask
       value={{ old($id, isset($modelo) ? $modelo->{$id} : '') }}>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
</div>
{{--
<label for="{{$id}}">@ucfirst($label)
    @if($required) <small class="required" style="color: red"> * </small>
    @endif
</label>
<input type="text" class="form-control datepicker_cubanacan @error($id) is-invalid @enderror {{$class ?? ""}}"
       name="{{$id}}" id="{{$id}}" >

@section('jscript')
    <script type="text/javascript">
        $('.datepicker_cubanacan').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "minYear": 1959,
            "showWeekNumbers": true,
            "autoApply": true,
            "showCustomRangeLabel": false,
            "alwaysShowCalendars": true,
            "startDate": "10/01/2020",
            "endDate": "03/04/2021",
            "applyButtonClasses": "btn-danger",
            "locale": {
                format: 'DD/MM/YYYY'
            }
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection--}}
