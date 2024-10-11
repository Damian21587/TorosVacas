@extends('layouts.app')
@section('content')
    @include('admin.modal-cancel', ['route'=>route('admin.manager.roles.index')])
    <x-content-section title="{{__('general.ttl_role_crear')}}">
        <x-slot name="content">
            <x-form id='addform' method='post' enctype=true action="{{route('admin.manager.roles.store')}}">
                <x-content-input>
                    <x-slot name="content">
                        <div class="form-group col-sm-6">
                            <x-form-textfield id="name" :required="true" label="{{__('general.lbrol')}}"/>
                        </div>
                        <div class="form-group col-sm-6">
                            <x-form-combobox-duallistbox id="permisos" required="true" label="{{__('general.lbpermisos')}}" :datos="$permisos" textnew="name_action" :multiple="true"/>
                        </div>
                    </x-slot>
                </x-content-input>
                @include('admin.footer_accion')
            </x-form>
        </x-slot>
    </x-content-section>
@endsection
