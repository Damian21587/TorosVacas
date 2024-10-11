{{--<li class="nav-item">
    <a href="{{ route('admin.infyOmGenerator.io_generator_builder') }}"
       target="_blank" class="nav-link">
        <i class="nav-icon fas fa-book-reader"></i>
        <span>Generator InfyOm CRUD</span>
    </a>
</li>--}}
@canany(['users.index', 'roles.index'])
<li class="nav-item has-treeview {{request()->routeIs('admin.manager.*') ? 'menu-open' :  ''}}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>
            Administración
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        @can('users.index')
            <li class="nav-item">
                <a href="{!! route('admin.manager.usuarios.index') !!}"
                   class="nav-link {{request()->routeIs('admin.manager.usuarios*') ? 'active' :  ''}}"><i
                        class="fa fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        @endcan
        @can('roles.index')
            <li class="nav-item">
                <a href="{!! route('admin.manager.roles.index') !!}"
                   class="nav-link {{request()->routeIs('admin.manager.roles*') ? 'active' :  ''}}"><i
                        class="fa fa-cog"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['game.index'])
<li class="nav-item has-treeview {{request()->routeIs('admin.content.*') ? 'menu-open' :  ''}}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        {{--<i class="fa fa- fa-slideshare "></i>--}}
        <p>
            Contenido
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @can('game.index')
            <li class="nav-item">
                <a href="{!! route('admin.content.game.index') !!}"
                   class="nav-link {{request()->routeIs('admin.content.game*') ? 'active' :  ''}}"><i
                        class="fa fa-play-circle"></i>
                    <span>Jugar</span>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany


