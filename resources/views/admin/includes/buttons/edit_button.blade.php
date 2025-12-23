@if (Route::has($base_route . '.edit'))
<a href="{{ route($base_route . '.edit', ['id' => $row->id]) }}" data-original-title="Edit data" class="btn btn-icon btn-primary btn-sm "><i class="far fa-edit"></i></a>
@endif
