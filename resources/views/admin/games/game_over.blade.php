@extends('layouts.app')
@section('content')
    @include('admin.modal-cancel', ['route'=>route('admin.content.game.index')])
    <x-content-section title="{{__('general.ttl_gameOver')}}">
        <x-slot name="content">
            <h1>Game Over !!!</h1>
            <p>{{ $message }}</p>
            <h4>Número secreto adivinar: <span
                    class="badge badge-success"> {{$secretNumber}}</span></h4>
            <a href="{{route('admin.content.game.create')}}">Volver a Jugar</a>
        </x-slot>
    </x-content-section>
@endsection
