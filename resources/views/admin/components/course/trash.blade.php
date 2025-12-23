@extends('admin.layout.admin')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $panel }} Trash list</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">{{ $panel }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $panel }} Trash Table</h4>
                                @include('admin.includes.buttons.back_button')

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped v_center">
                                        <tr>
                                            <th>Title</th>
                                            <th>Buttons</th>
                                            <th>Action</th>
                                        </tr>
                                        @if (isset($data['rows']))
                                            @foreach ($data['rows'] as $row)
                                                <tr>

                                                    <td>{{ $row->title }}</td>
                                                    <td>
                                                        @if ($row->action_button_left || $row->action_button_right)
                                                            <div class="d-flex flex-wrap gap-2 mx-1">
                                                                @if ($row->action_button_left && $row->action_button_left_link)
                                                                    <a href="{{ $row->action_button_left_link }}"
                                                                        title="{{ $row->action_button_left_link }}"
                                                                        class="btn btn-outline-primary btn-sm"
                                                                        target="_blank">
                                                                        {{ $row->action_button_left }}
                                                                    </a>
                                                                @endif

                                                                @if ($row->action_button_right && $row->action_button_right_link)
                                                                    <a href="{{ $row->action_button_right_link }}"
                                                                        title="{{ $row->action_button_right_link }}"
                                                                        class="btn btn-outline-secondary btn-sm"
                                                                        target="_blank">
                                                                        {{ $row->action_button_right }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-muted">No buttons</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{-- @include('admin.inudes.buttons.edit_button') --}}
                                                        @include('admin.includes.buttons.forcedelete_button')
                                                        @include('admin.includes.buttons.restore_button')
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
