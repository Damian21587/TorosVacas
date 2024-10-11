<td style={{$style ?? "width: 120px;"}} class={{$class ?? "text-center"}}>
    <x-btnlink class="btn-info btn-sm">
        <x-slot name="href">
            {{ route($route_edit, $id) }}
        </x-slot>
        <i class="fas fa-pencil-alt"> </i>
    </x-btnlink>
    <a href="" data-toggle="modal"
       data-route="{{route($route_destroy, $id)}}"
       data-target="#modal-delete" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"> </i>
    </a>
</td>
