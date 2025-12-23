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
                                @include('admin.includes.buttons.trash_button')
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped v_center" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Full Fee</th>
                                                <th>Half Fee</th>
                                                <th>Status</th>
                                                <th>Modified By/At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('cms/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('cms/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let baseRoute = "{{ url($base_route) }}";

            $('#table-2').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route($base_route . '.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },


                    {
                        data: 'full_fee',
                        name: 'full_fee',
                        
                    },
                    {
                        data: 'half_fee',
                        name: 'half_fee',
                        
                    },
                    {
                        data: 'status',
                        name: 'status',
                       
                    },
                    {
                        data: null,
                        name: 'modified_or_created',
                        render: function(data) {
                            function formatDateTime(dateString) {
                                const date = new Date(dateString);
                                const year = date.getFullYear();
                                const month = date.getMonth() + 1;
                                const day = date.getDate();

                                let hours = date.getHours();
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const ampm = hours >= 12 ? 'PM' : 'AM';
                                hours = hours % 12 || 12; // convert to 12-hour format

                                return `${year}/${month}/${day} ${hours}:${minutes} ${ampm}`;
                            }

                            if (data.updated_by) {
                                return `${data.updated_by.name}<br>${formatDateTime(data.updated_at)}`;
                            } else {
                                return `${data.created_by.name}<br>${formatDateTime(data.created_at)}`;
                            }
                        }
                    },

                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            const editUrl = `/admin/courses/edit/${data}`;
                            const deleteUrl = `/admin/courses/delete/${data}`;
                            return `
                                <a href="${editUrl}" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>
                                <form action="${deleteUrl}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            `;
                        }
                    }
                ],
                columnDefs: [{
                    targets: [3],
                    orderable: false,
                    searchable: false
                }],
                order: [
                    [0, 'asc']
                ],
            });
        });
    </script>
@endpush
