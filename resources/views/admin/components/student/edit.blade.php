    @extends('admin.layout.admin')
    @push('css')
        <!-- CSS Libraries -->
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet" href="{{ asset('cms/assets/modules/jquery-selectric/selectric.css') }}">
    @endpush
    @section('content')
        <!-- Start app main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>{{ $panel }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">{{ $panel }}</a></div>
                        <div class="breadcrumb-item">Edit</div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit {{ $panel }}</h4>
                                </div>
                                <form action="{{ route($base_route . '.update', $data['row']->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">
                                        {{-- Section: Basic Details --}}
                                        <h5 class="mb-4">Basic Details</h5>
                                    
                                        {{-- Name --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name',$data['row']->name) }}" placeholder="e.g. Loan Rates"
                                                    required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        {{-- Section: Call To Action Settings --}}
                                        <h5 class="mt-5 mb-4">Call To Action (CTA) Button Settings</h5>
                                    
                                       
                                        {{-- Color --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Button Color</label>
                                            <div class="col-sm-9">
                                                <input type="color" name="color"
                                                    class="form-control @error('color') is-invalid @enderror"
                                                    value="{{ old('color',$data['row']->color) }}">
                                                @error('color')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        {{-- Short Description --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Short Description (Max 1000 words)</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_description" 
                                                    class="form-control @error('short_description') is-invalid @enderror"
                                                    rows="4"
                                                    placeholder="Brief description...">{{ old('short_description',$data['row']->short_description) }}</textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                       
                                        {{-- Status --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="status"
                                                    class="form-select @error('status') is-invalid @enderror">
                                                    <option value="1" {{ old('status',$data['row']->status) == '1' ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ old('status',$data['row']->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        {{-- Submit --}}
                                        <div class="row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    @endsection
    @push('js')
        <!-- Page Specific -->
        <script src="{{ asset('cms/assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ asset('cms/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('cms/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
        <script src="{{ asset('cms/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('cms/js/page/features-post-create.js') }}"></script>
    @endpush
