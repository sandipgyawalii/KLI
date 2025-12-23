@if (Route::has($base_route . '.forcedelete'))
    <form action="{{ route($base_route . '.forcedelete', ['id' => $row->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button data-original-title="force Delete data" id="swal-6"  type="submit"
            class="btn btn-icon btn-danger btn-sm"> <i class="fas fa-trash"></i>
        </button>
    </form>
@endif
