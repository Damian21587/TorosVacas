<label for="{{$id}}">@ucfirst($label)
    @if($required)
        <small class="required" style="color: red"> *</small>
    @endif
</label>

<div class="custom-file">
    <input type="file" class="custom-file-input form-control-file @error($id) is-invalid @enderror {{$class ?? ""}}"
           style="width: 100%; {{$style ?? ""}}" name="{{$id}}" id="{{$id}}"
           value="{{ old($id, isset($modelo) ? $modelo->{$id} : '') }}" placeholder="{{$placeholder ?? ''}}"
           @isset($accept) accept="{{$accept}}" @endisset>
    <label class="custom-file-label" for="exampleInputFile">Seleccionar
        archivo</label>
    {!! $errors->first($id, '<span class="error invalid-feedback" role="alert">:message</span>') !!}
</div>
@isset ($help)
    @isset ($help3)
        <span class="help-block form-text text-muted text-small">{{ $help3 }}</span>
    @endisset
    <div>
        <span class="help-block form-text text-muted text-small">{{ $help }}</span>
    </div>
    @isset ($help2)
        <span class="help-block form-text text-muted text-small">{{ $help2 }}</span>
    @endisset
@endisset
@isset ($showList)
    @if(isset($modelo))
        <div class="mt-3">
            <output id="{{$showList}}">
            <span>
                <img src="{{asset('/storage/'.old($id, isset($modelo->{$id}->url) ? $modelo->{$id}->url : ''))}}"
                     class="thumb img-circle img-thumbnail" alt="Imagen">
            </span>
            </output>
        </div>
    @else
        <div class="mt-3">
            <output id="{{$showList}}">
            </output>
        </div>
    @endif
@else
    @if(isset($modelo->{$id})!=null)
        <div class="mt-3">
            <a href="{{asset('/storage/'.$modelo->{$id})}}"
               target="_blank">{{asset('/storage/'.$modelo->{$id})}}</a>
        </div>
    @endif
@endisset
@push('page_scripts')
    <script type="text/javascript">
        function handleFileSelect(evt) {
            var files = evt.target.files; // FileList object
            // Loop through the FileList and render image files as thumbnails.

            const thumbs = document.querySelectorAll('.thumb');
            var elementoslist = document.getElementById('{{$showList}}');

            if (thumbs.length >= 1) {
                elementoslist.innerHTML = ''
            }
            for (var i = 0, iMax = files.length; i < iMax; i++) {
                var reader = new FileReader();
                let f = files[i];

                // Closure to capture the file information.
                reader.onload = (theFile => e => {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb img-circle img-thumbnail"  src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    elementoslist.insertBefore(span, null);
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);

            }
        };
        document.getElementById('{{$id}}').addEventListener('change', handleFileSelect, false);
    </script>
@endpush
