@if (Route::has($base_route . '.show'))
<a href="{{ route($base_route . '.show', ['id' => $row->id]) }}" data-original-title="show data" class="btn btn-icon btn-primary btn-sm"><i class="far fa-eye"></i></a>
@endif
