<label for="{{$id}}"> @ucfirst($label)
        @if($required)
                <small class="required" style="color: #DA2513"> *</small>
        @endif
</label>
<select class="form-control @if(isset($multiple)) duallistbox @else select2bs4 @endif @error($id) is-invalid @enderror {{$class ?? ""}}"
        style="width: 100%; {{$style ?? ""}}" name="{{isset($multiple) ?  $id.'[]' : $id}}" id="{{$id}}" @if(isset($multiple)) multiple="multiple"
        @endif {{--@if(isset($disabled)) disabled="{{$disabled}}" @endif @if(isset($readOnly))readonly="{{$readOnly}}"@endif--}}>
        @if(!isset($multiple))
                <option value="" class="text-muted text-center">@lang('general.lbSeleccionar')</option>
        @endif
        @foreach ($datos as $record)
                <option value="@if(isset($value)){{ $record->{$value} }}@else{{ $record->id }}@endif"
                        @if(isset($modelo))
                        @if(isset($multiple))
                        @if(in_array($record->id,$modelo->{$id}))
                        selected="selected"
                        @endif
                        @endif
                        @if(old($id, $modelo->{$id}) == $record->id) selected="selected"
                        @endif
                        @else
                        @if(isset($multiple))
                        @if( !empty(old($id)) && in_array($record->id, old($id))) selected="selected"
                        @endif
                        @else
                        @if( old($id) == $record->id ) selected="selected"
                        @endif
                        @endif
                        @endif>

                        @if(isset($textlocale)) {{ $record->getTranslation($textlocale,'es') }}
                        @else
                                @if(isset($textnew))
                                        {{ $record->{$textnew} }}
                                @else {{ $record->name }}
                                @endif
                        @endif</option>
        @endforeach
</select>
{!! $errors->first($id, '<span class="error invalid-feedback">:message</span>') !!}
