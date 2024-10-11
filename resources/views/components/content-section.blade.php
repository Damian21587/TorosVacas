<section class="content">
    {{--@include('adminlte-templates::common.errors')--}}
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-green">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- general form elements -->
                <div class="card-body">
                    {{$content}}
                </div>
            </div>
        </div>
    </div>
</section>
