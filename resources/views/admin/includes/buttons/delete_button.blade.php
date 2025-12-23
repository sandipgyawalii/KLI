@if (Route::has($base_route . '.destroy'))
    <form action="{{ route($base_route . '.destroy', ['id' => $row->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button data-original-title="Delete data" id="swal-6"  type="submit"
            class="btn btn-icon btn-danger btn-sm"> <i class="fas fa-trash"></i>
        </button>
    </form>
@endif
