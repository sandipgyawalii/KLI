@extends('admin.layout.admin')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $panel }} list</h1>
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
                                <h4>{{ $panel }} Table</h4>
                                @include('admin.includes.buttons.create_button')
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped v_center">
                                        <tr>
                                            <th>Appplication Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        @if(isset($data['rows']))
                                        @foreach($data['rows'] as $row)
                                        <tr>
                                          
                                            <td>{{ $row->application_name }}</td>
                                            <td>
                                                {{ $row->address }}
                                            </td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                @include('admin.includes.buttons.edit_button')
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
