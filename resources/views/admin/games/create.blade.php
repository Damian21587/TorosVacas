@extends('layouts.app')
@section('content')
    @include('admin.modal-cancel', ['route'=>route('admin.content.game.index')])
    <x-content-section title="{{__('general.ttl_torosvacas_crear')}}">
        <x-slot name="content">
            <x-form id='addform' method='post' enctype=true action="{{route('admin.content.game.store')}}">
                <x-content-input>
                    <x-slot name="content">


                        <div class="form-group col-sm-4">
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Tiempo Estimado:</span>
                                    <span class="info-box-number text-center text-muted mb-0">1 minuto</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                        </div>
                        <div class="form-group col-sm-3">
                            <x-form-combobox-duallistbox id="user_id" required="true" :datos="$players"
                                                         label="{{__('general.lbusuario')}}"/>
                        </div>

                        <div class="form-group col-sm-3">
                            <x-form-textfield id="age" :required="true" label="{{__('general.lbedad')}}"/>
                        </div>

                        <div class="form-group col-sm-3">
                            <x-form-textfield id="guess" :required="true" label="{{__('general.lbadivinar')}}"/>
                        </div>
                        <div class="form-group col-sm-3">
                        </div>
                        @if (isset($result))

                            <div class="col-6">
                                <p class="lead">Resultado</p>
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Número secreto:</th>
                                        <td><span class="badge badge-success">{{ $secretNumber }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Resultado de Adivinar:</th>
                                        <td>@if($secretNumber==$guess) <span
                                                class="badge badge-success">{{ $guess }}</span> @else <span
                                                class="badge badge-danger">{{ $guess }}</span>@endif</td>
                                    </tr>
                                    <tr>
                                        <th>Toros:</th>
                                        <td><span class="badge badge-primary">{{  $result['bulls'] }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Vacas:</th>
                                        <td><span class="badge badge-warning">{{  $result['cows'] }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Intentos:</th>
                                        <td><span class="badge badge-info">{{ $attempts }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Evaluación:</th>
                                        <td><span class="badge badge-secondary">{{ $evaluation }} punto(s)</span></td>
                                    </tr>
                                    <tr>
                                        <th>Ranking:</th>
                                        <td><span class="badge badge-secondary">{{ $ranking }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            @if($secretNumber==$guess)
                                <div class="col-6" style="margin-top: 70px;">
                                    <h1 class="lead text-success"><strong>CONGRATULATIONS !!!</strong></h1>

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Your have won the game.
                                    </p>
                                </div>
                            @endif

                        @endif
                        @if(isset($message))
                            <div class="col-6" style="margin-top: 40px;">
                                <h1 class="lead text-danger"><strong>Error !!!</strong></h1>

                                <p class=" well well-sm shadow-none text-danger" style="margin-top: 10px;">
                                    {{$message}}
                                </p>
                            </div>
                        @endif
                        @if ($players)
                            <div class="col-9" style="margin-top: 70px;">
                                <x-content-index title=" {{ __('general.ttl_gameRanking')}}">
                                    <x-slot name="columns_header">
                                        <th>@ucfirst('general.lbusuario')</th>
                                        <th>@ucfirst('general.lbpuntuaje')</th>
                                    </x-slot>
                                    <x-slot name="columns_body">
                                        @foreach($players as $player)
                                            <tr>
                                                <td>{{ $player->name }}</td>
                                                <td>{{ $player->score }}</td>
                                            </tr>
                                        @endforeach
                                    </x-slot>
                                </x-content-index>
                            </div>
                        @endif
                    </x-slot>
                </x-content-input>
                @include('admin.footer_accion')
            </x-form>
        </x-slot>
    </x-content-section>
@endsection
