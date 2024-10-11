<div class="card card-green card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active " id="custom-tabs-one-es-tab"
                   data-toggle="pill" href="#custom-tabs-one-es" role="tab"
                   aria-controls="custom-tabs-one-es" aria-selected="true"><img class="img-circle" width="30px" height="30px"
                                                                                src="{{ asset('flags/1x1/es.svg')}}" alt="flag"/>&nbsp;&nbsp;ES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-en-tab" data-toggle="pill"
                   href="#custom-tabs-one-en" role="tab"
                   aria-controls="custom-tabs-one-en" aria-selected="false"><img class="img-circle" width="30px" height="30px"
                                                                                 src="{{ asset('flags/1x1/us.svg')}}" alt="flag"/>&nbsp;&nbsp;EN</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-one-es"
                 role="tabpanel"
                 aria-labelledby="custom-tabs-one-es-tab">
                <div class="box-body">
                    {{$content}}
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-en" role="tabpanel"
                 aria-labelledby="custom-tabs-one-en-tab">
                <div class="tab-pane fade show active" id="custom-tabs-one-en"
                     role="tabpanel" aria-labelledby="custom-tabs-one-en-tab">
                    <div class="box-body">
                        {{$content}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
