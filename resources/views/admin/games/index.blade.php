@extends('layouts.app')
@section('content')
    <section class="content-header">
        <x-btnlink-add href="{{route('admin.content.game.create')}}"/>
    </section>
    <section class="content">
        <x-content-index title=" {{ __('general.ttl_torosvacas_listar')}}">
            <x-slot name="columns_header">
                <th>@ucfirst('general.lbusuario')</th>
                <th>@ucfirst('general.lbadivinar')</th>
                <th>@ucfirst('general.lbevaluacion')</th>
                <th>@ucfirst('general.lbtoros')</th>
                <th>@ucfirst('general.lbvacas')</th>
                <th>@ucfirst('general.lbcreadoPor')</th>
                <th class="text-center">@ucfirst('general.acciones')</th>
            </x-slot>
            <x-slot name="columns_body">
                @foreach($games as $game)
                    <tr>
                        <td>{{ $game->user->name }}</td>
                        <td>{{ $game->guess }}</td>
                        <td>{{ $game->evaluation }}</td>
                        <td>{{ $game->bulls }}</td>
                        <td>{{ $game->cows }}</td>
                        <td>{{ $game->created_by }}</td>
                        <td class="text-center" style="width: 150px;">
                            {{--@can('game.edit')
                                <a href="{{route('admin.content.game.edit', $game->id)}}"
                                   class="btn btn-info btn-sm" data-toggle="tooltip" title="Editar"><i
                                        class="fas fa-pencil-alt"></i></a>
                            @endcan--}}
                            @can('game.destroy')
                                <a href="" data-toggle="modal"
                                   data-route="{{route('admin.content.game.destroy', $game->id)}}"
                                   data-target="#modal-delete" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                   title="Eliminar"><i class="fas fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-content-index>
    </section>
@endsection
