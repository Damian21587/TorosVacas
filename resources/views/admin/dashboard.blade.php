@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    </div>
</div>
@endsection
<style>
    .stars{
        font-size:8rem!important;
        color: rgba(99, 99, 99, 0.3);
    }
    .sactive{
        color: #f39c12;
    }
    .stars-container{
        display: flex;
        justify-content: space-around;
    }
    @media screen and (max-width: 746px) {
        .stars{
            font-size:3rem!important;
        }
    }
</style>
