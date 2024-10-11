<div class="row">
    <div class="col-12">
       {{-- @include('admin.session')--}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="{{$tableId ?? "example1"}}"
                       class="table {{ $tableClass ?? "table-bordered table-striped" }}">
                    <thead>
                    <tr>
                        {{$columns_header}}
                    </tr>
                    </thead>
                    <tbody>
                    {{$columns_body}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

