@extends('layouts.app')
@section('content')
    @include('admin.modal-cancel', ['route'=>route('admin.manager.roles.index')])
    <x-content-section title="{{__('general.ttl_role_editar')}}">
        <x-slot name="content">
            <x-form id='addform' method='post' enctype=true action="{{route('admin.manager.roles.update',$role->id)}}" api='PUT'>
                <x-content-input>
                    <x-slot name="content">
                        <div class="form-group col-sm-6">
                            <x-form-textfield id="name" :required="true" label="{{__('general.lbrol')}}" :modelo="$role"/>
                        </div>
                        <div class="form-group col-sm-6">
                            <x-form-combobox-duallistbox id="permisos" required="true" label="{{__('general.lbpermisos')}}" :datos="$permisos" :modelo="$role" :multiple="true" textnew="name_action"/>
                        </div>
                    </x-slot>
                </x-content-input>
                @include('admin.footer_accion')
            </x-form>
        </x-slot>
    </x-content-section>
@endsection
