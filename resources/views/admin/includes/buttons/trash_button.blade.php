    @if (Route::has($base_route . '.trash'))
    <a href="{{ route($base_route.'.trash') }}" class="btn btn-danger mx-auto"><i class="fa fa-trash" aria-hidden="true"></i></a>                              
    @endif