<div class="card card-outline card-green  @error($id) is-invalid  @enderror">
    <div class="card-header">
        <h3 class="card-title">
            <label for="{{$id}}">@ucfirst($label)
                @if($required)
                    <small class="required" style="color: red"> *</small>
                @endif
            </label>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="preview-images-zone">
            <div id="{{$galeryId}}" class="col ">
                <blockquote class="blockquote text-center">
                    <p class="mb-0">No hay im&aacute;genes a mostrar</p>
                    @if(isset($limites))
                        <footer class="blockquote-footer">
                            {{__('inifat.limite', ['dim' => $limites])}}
                        </footer>
                    @endif
                    <footer class="blockquote-footer">
                        {{ __('inifat.extensiones')}}
                    </footer>
                    @if(isset($dimensions))
                        <footer class="blockquote-footer">
                            {{__('inifat.dimensiones', ['dim' => $dimensions])}}
                        </footer>
                    @endif
                    <footer class="blockquote-footer">
                        {{__('inifat.soloadmite', ['dim' => $countImages])}}

                    </footer>
                </blockquote>
            </div>
        </div>
        {{-- <input type="hidden" class="form-control @error($id) is-invalid @enderror">--}}
    </div>
    <div class="card-footer center " align="center">
        <input type="file" name="{{$id.'[]'}}" id="{{$id}}"
               multiple="multiple"
               class="form-control d-none" accept="image/*"/>
        <a type="button"
           class="btn btn-sm btn-success text-center mx-auto"
           href="javascript:void(0)"
           onclick="$('#{{$id}}').click()"><i
                class="fas fa-upload"></i> Cargar im&aacute;genes...</a>
    </div>
</div>
@if ($errors->has($id.'.*'))
    {!! $errors->first($id.'.*', '<span class="error invalid-feedback d-block" role="alert">:message</span>') !!}
@else
    {!! $errors->first($id, '<span class="error invalid-feedback" role="alert">:message</span>') !!}
@endif
@push('page_scripts')
    <script type="text/javascript">
        /**
         * Read image from source.
         *
         * @param {EventTarget} event
         * @author Ing. Damian Gazmuriz Adan <dgazmuriz@gmail.com>
         */

        let num = 0;
        let galeria_imagenesBD = [];
        @if(isset($galeriaImagenes))
        const dt = new DataTransfer(), output = $(".preview-images-zone"), imagesInit = output.children(),
            images = imagesInit.find('.image-zone > img'), countChildImages = images.length;

        @foreach ($galeriaImagenes as $imagen )
        galeria_imagenesBD.push(@json($imagen));
        @endforeach

        if (galeria_imagenesBD.length > 0)
            num = galeria_imagenesBD.length;
        @endif
        $(document).ready(function () {
            @if(isset($galeriaImagenes))
            mostrarGaleriaImagenesBD()
            @endif
            document.querySelector("#{{$id}}").onchange = readImage;
            $(document).on('click', '.image-cancel', function () {
                let no = $(this).data('no');

                @if(isset($galeriaImagenes))
                let url = $(this).data('route');
                let imagen_eliminada = '';
                let id_modelo = {!! json_encode($modelo->id)  !!}

                    imagen_eliminada = galeria_imagenesBD.splice(no, 1);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: url,
                    method: "POST",
                    data: {
                        imagen_eliminada: imagen_eliminada,
                        id: id_modelo
                    },
                    /*contentType: false,
                    cache: false,
                    processData: false,*/
                    dataType: "json",
                    success: function (data) {
                        if (data.success)
                            window.location.reload();
                    },
                    error: function (data) {
                    }
                });
                @else
                removeFile(no)
                @endif

                $(".preview-image.preview-show-" + no).remove();
                num--;
                if (num == 0)
                    $("#{{$galeryId}}").removeClass("d-none")
            });
        });


        //Cargar Imagen cuando cuando vienen del controlador

        //Cargar Imagen
        function readImage(event) {
            if (window.File && window.FileList && window.FileReader) {
                const files = event.target.files; //FileList object
                const output = $(".preview-images-zone"), imagesInit = output.children(),
                    images = imagesInit.find('.image-zone > img'),
                    countChildImages = images.length;
                /*let multiple = {{--{!! json_encode($multiple)  !!}--}}*/
                if (files.length + countChildImages <= {{$countImages}}) {
                    $('#{{$galeryId}}').addClass('d-none');
                    for (let i = 0; i < files.length; i++) {
                        if (!files[i].type.match('image')) continue;
                        let picReader = new FileReader();
                        picReader.addEventListener('load', function (event) {
                            output.append('<div class="preview-image preview-show-' + num + '">' +
                                '<div class="image-cancel" data-no="' + num + '">x</div>' +
                                '<div class="image-zone"><img id="pro-img-' + num + '" src="' + event.target.result + '"></div>' +
                                '</div>');
                            num++;
                        });
                        picReader.readAsDataURL(files[i])
                    }
                } else
                    toastr.error('El campo Galería de Imágenes solo admite {{$countImages}} elementos.')
                //document.querySelector("#imagen_galeria").files = dt.files;
            } else {
                $('#{{$galeryId}}').removeClass('d-none');
            }
        }

        function removeFile(index) {
            var attachments = document.getElementById("{{$id}}").files; // <-- reference your file input here
            var fileBuffer = new DataTransfer();

            // append the file list to an array iteratively
            for (let i = 0; i < attachments.length; i++) {
                // Exclude file in specified index
                if (index !== i)
                    fileBuffer.items.add(attachments[i]);
            }
            // Assign buffer to file input
            document.getElementById("{{$id}}").files = fileBuffer.files; // <-- according to your file input reference
        }

        function mostrarGaleriaImagenesBD() {

            let resultado = ''
            let d_none = ''
            $('.preview-images-zone').html('');

            $.each(galeria_imagenesBD, function (index, item) {
                resultado += '<div class="preview-image preview-show-' + index + '">' +
                    '<div class="image-cancel" data-no="' + index + '" data-route="{{$rutaEliminarImagen}}">x</div>' +
                    '<div class="image-zone"><img id="pro-img-' + index + '" src="/storage/' + item['url'] + '"> </div>' +
                    '</div>'
            })
            if (galeria_imagenesBD.length > 0)
                d_none = 'd-none'

            resultado += '<div id="no-gallery" class="col ' + d_none + '">' +
                '<blockquote class="blockquote text-center">' +
                '<p class="mb-0">No existen im&aacute;genes para esta galer&iacute;a</p>' +
                '<footer class="blockquote-footer">{{__('inifat.extensiones')}}</footer>' +
                @if(isset($dimensions))
                    '<footer class="blockquote-footer">{{__('inifat.dimensiones', ['dim' => $dimensions])}}</footer>' +
                @endif
                '<footer class="blockquote-footer">{{__('inifat.soloadmite', ['dim' => $countImages])}}</footer>' +
                '</div>'

            $('.preview-images-zone').append(resultado)

        }

        function validateImageUnaVez(lastModified) {
            var result = false;
            let files = document.querySelector("#{{$id}}").files;
            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    if (files[i].lastModified == lastModified)
                        result = true
                }
                return result
            }
            console.log(result)
            return result
        }
    </script>
@endpush
