    @if (Route::has($base_route . '.create'))
    <a href="{{ route($base_route.'.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
        Create {{ $panel }}</a>                              
    @endif