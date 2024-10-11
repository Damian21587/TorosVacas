<aside class="main-sidebar sidebar-dark-green elevation-4">
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('image/images.jpg')}}"
             alt="{{ config('app.name') }} Logo"
             class="brand-image img-circle elevation-4" style="width:20%; height:20%;">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="@if(isset(Auth::user()->image->url))
                {{asset('/storage/'.Auth::user()->image->url)}}
                @else
                {{asset('image/user2-160x160.jpg')}}
                @endif" class="img-circle elevation-2" alt="User Image">
            </div>
            @if(isset(  Auth()->user()->role_id) == 1)
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }} - {{ auth()->user()->rol->name }}</a>
                    <a href="/" target="_blank"><i class="fa fa-circle text-success"></i> Conectado</a>
                </div>
            @endif
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link {{request()->is('admin')? 'active' :  ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
