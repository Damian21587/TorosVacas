<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
{{--    <link rel="stylesheet" href="{{ asset('css/materialdesignicons.scss')}}">--}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css')}}"/>
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/summernote/summernote-bs4.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/toastr/toastr.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"/>
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/select2/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('adminLTE/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/styles-admin.css')}}">

    {{--<link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous"/>--}}

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('image/35.gif')}}" {{--alt="AdminLTELogo"--}} height="60" width="60">
    </div>

    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="@if(isset(Auth::user()->image->url))
                    {{asset('/storage/'.Auth::user()->image->url)}}
                    @else
                    {{asset('image/user2-160x160.jpg')}}
                    @endif" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">@if(isset(auth()->user()->name )) {{auth()->user()->name}} @endif</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-header text-center text-green">
                        <strong >Cuenta</strong>
                    </div>
                    <!-- User image -->
                    <li class="user-header bg-green">
                        <img src="@if(isset(Auth::user()->image->url))
                        {{asset('/storage/'.Auth::user()->image->url)}}
                        @else
                        {{asset('image/user2-160x160.jpg')}}
                        @endif" class="user-image img-circle elevation-2" alt="User Image">
                        {{-- <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>--}}
                        <p>
                            {{ Auth::user()->name }} - {{ auth()->user()->rol->name }}
                            <small>{{ date('D').' '.date('M').'  '.date('Y') }}</small>
                            {{-- <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>--}}
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-header" style="height: 55px">
                        {{-- <a href="#" class="btn btn-default btn-flat">Perfil</a>--}}
                        <a href="#" class="btn btn-default btn-flat"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off text-green" > Salir</i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <!-- Blades de Flash mensajes y Modal de eliminacion de contenidos -->
            @include('admin.flash-session')
            @include('admin.modal-delete')
            @yield('content')
        </section>
        {{-- <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
             <i class="fas fa-chevron-up"></i>
         </a>--}}
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}} <a href="https://adminlte.io">{{config('app.name')}}</a>.</strong>Todos
        los
        derechos reservados.
    </footer>
</div>

<!-- jQuery -->
<script src="{{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminLTE/dist/js/adminlte.min.js')}}"></script>
{{--<script src="{{asset('adminLTE/dist/js/demo.js')}}"></script>--}}

<!-- DataTables  & Plugins -->
<script src="{{asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Toastr -->
<script src="{{asset('adminLTE/plugins/toastr/toastr.min.js')}}"></script>

<!-- Summernote -->
<script src="{{asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('adminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- InputMask -->
<script src="{{asset('adminLTE/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminLTE/plugins/inputmask/jquery.inputmask.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('adminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('adminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('adminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('adminLTE/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('adminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>

{{--<script src="{{asset('adminLTE/plugins/bootstrap/js/bootstrap.min.js')}}"></script>--}}

<script type="text/javascript">
    $(function () {
        bsCustomFileInput.init();
    });

    /*$('.custom-file-input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));
    });*/

    $('.telefono_mask').inputmask('(+53) 9999-99-99')

    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true,
        "pageLength": 10,
        order: [],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    })/*.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')*/;

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $('#reservation').daterangepicker();

    // Summernote textarea
    $('.textarea').summernote({});

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox();

    //Colorpicker
    $('.my-colorpicker1').colorpicker();

    //Flash de mensajes de contenido
    setTimeout(function () {
        $('.contenido').fadeOut(1500);
    }, 2000);

    //Pasar accion al formulario dentrol del modal para eliminar contenido
    $('#modal-delete').on('show.bs.modal', function(e) {
        var $this = $(e.relatedTarget);
        var data_route = $this.data('route');
        var modal = $('#modal-delete');
        modal.find('#form_delete').attr('action', function () {
            return data_route;
        });
    });



    /*// DropzoneJS Demo Code Start

    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () {
            myDropzone.enqueueFile(file)
        }
    })

    /!*!// Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })*!/

    /!*myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })*!/

    /!*!// Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })*!/

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    /!*document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }*!/
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End*/
</script>

@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
