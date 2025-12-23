@if (Route::has($base_route . '.restore'))
<a href="{{ route($base_route . '.restore', ['id' => $row->id]) }}" data-original-title="Edit data" class="btn btn-icon btn-primary btn-sm "><i class="fas fa-trash-restore"></i></a>
@endif
