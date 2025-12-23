    @extends('admin.layout.admin')
@push('css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('cms/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/assets/modules/codemirror/theme/duotone-dark.css') }}">
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
                <form action="{{ route($base_route . '.update',$data['row']->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">

                        {{-- Application Details --}}
                        <h5 class="mb-3">Application Info</h5>
                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-3">Application Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" name="application_name" class="form-control @error('application_name') is-invalid @enderror"
                                    value="{{ old('application_name',$data['row']->application_name) }}" placeholder="e.g. Mero Rate" required>
                                @error('application_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-3">Application Slogan</label>
                            <div class="col-md-7">
                                <input type="text" name="application_slogan" class="form-control @error('application_slogan') is-invalid @enderror"
                                    value="{{ old('application_slogan',$data['row']->application_slogan) }}" placeholder="e.g. Compare & Save Smartly">
                                @error('application_slogan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-3">Address <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address',$data['row']->address) }}" placeholder="e.g. Kathmandu, Nepal" required>
                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Contact Info --}}
                        <h5 class="mt-4 mb-3">Contact Info</h5>
                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-3">Phone<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone',$data['row']->phone) }}" placeholder="e.g. +977 9800000000">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-3">Email<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email',$data['row']->email) }}" placeholder="e.g. info@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Social Media Links --}}
                        <h5 class="mt-4 mb-3">Social Media</h5>
                        @php
                            $socials = ['facebook', 'instagram', 'twitter', 'linkedin'];
                        @endphp
                        @foreach ($socials as $social)
                            <div class="form-group row mb-3">
                                <label class="col-form-label col-md-3 text-capitalize">{{ ucfirst($social) }}</label>
                                <div class="col-md-7">
                                    <input type="text" name="{{ $social }}" class="form-control @error($social) is-invalid @enderror"
                                        value="{{ old($social,$data['row']->$social) }}" placeholder="https://{{ $social }}.com/your-page">
                                    @error($social)<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        @endforeach

                        {{-- Submit --}}
                        <div class="form-group row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Submit Application Info</button>
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
    <!-- JS Libraies -->
    <script src="{{ asset('cms/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('cms/assets/modules/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('cms/assets/modules/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('cms/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('cms/js/page/features-post-create.js') }}"></script>
@endpush
