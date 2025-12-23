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
                                <form action="{{ route($base_route . '.update',$data['row']->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf

                                    <div class="card-body">

                                        {{-- ================= Course Information ================= --}}
                                        <h5 class="mb-4">Course Information</h5>

                                        {{-- Course Name --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Course Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name',$data['row']->name) }}" placeholder="Enter course name" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        {{-- Description --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror  summernote " rows="4"
                                                    placeholder="Course description">{{ old('description',$data['row']->description) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- ================= Pricing & Media ================= --}}
                                        <h5 class="mb-4 mt-5">Pricing & Media</h5>

                                        {{-- Price --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Course Price</label>
                                            <div class="col-sm-9">
                                                <input type="number" step="0.01" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price',$data['row']->price) }}" placeholder="e.g. 100000">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Image --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Course Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- ================= Status ================= --}}
                                        @include('admin.includes.buttons.status_form_input')


                                        {{-- Submit --}}
                                        <div class="row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    Submit Course
                                                </button>
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
