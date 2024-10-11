<div class="contenido">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div id="toast-container" class="toast-top-right">
                    <div class="toast toast-success toastsDefaultAutohide" aria-live="polite">
                        <div class="toast-message">{{ session('success') }}</div>
                    </div>
                </div>
            @endif
            @if (session('failed'))
                <div id="toast-container" class="toast-top-right">
                    <div class="toast toast-error toastsDefaultAutohide" aria-live="polite">
                        <div class="toast-message">{{ session('failed') }}</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>