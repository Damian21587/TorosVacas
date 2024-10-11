@extends('layouts.app')

@section('content')
    <section class="content-header">
        <x-btnlink-add href="{{route('admin.manager.usuarios.create')}}"/>
    </section>
    <section class="content">
        <x-content-index title=" {{ __('general.ttl_usuario_listar')}}">
            <x-slot name="columns_header">
                <th>@ucfirst('general.lbnombreApellido')</th>
                <th>@ucfirst('general.lbemail')</th>
                <th>@ucfirst('general.lbrol')</th>
                <th class="text-center">@ucfirst('general.acciones')</th>
            </x-slot>
            <x-slot name="columns_body">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol->name }}</td>
                        <td style="width: 150px;">
                            @can('users.edit')
                                <a href="{{route('admin.manager.usuarios.edit', $user->id)}}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            @endcan
                            @can('users.edit')
                                <a href="{{--{{route('admin.manager.users.password-reset', $user->id)}}--}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Editar Contraseña"><i class="fa fa-key"></i></a>
                            @endcan
                            @can('users.destroy')
                                @if(Auth::user()->id == $user->id)
                                    <button class="btn btn-default" disabled><i class="fa fa-trash"></i></button>
                                @else
                                  <a href="" data-toggle="modal" data-route="{{route('admin.manager.usuarios.destroy', $user->id)}}" data-target="#modal-delete" class="btn btn-danger  btn-sm" data-toggle="tooltip" title="Eliminar"><i class="fas fa-trash"></i></a>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-content-index>
    </section>
@endsection

