    @extends('admin.layout.admin')
    @push('css')
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
                        <div class="breadcrumb-item">Create</div>
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
                                    <h4>Create {{ $panel }}</h4>
                                </div>
                                <form action="{{ route($base_route . '.store') }}" method="post">
                                    @csrf

                                    <div class="card-body">

                                        {{-- ================= Student Information ================= --}}
                                        <h5 class="mb-4">Student Information</h5>

                                        {{-- Full Name --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="Enter student name" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Contact Number --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Contact Number <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="contact_number"
                                                    class="form-control @error('contact_number') is-invalid @enderror"
                                                    value="{{ old('contact_number') }}" placeholder="+82 10-XXXX-XXXX"
                                                    required>
                                                @error('contact_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" placeholder="student@email.com">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- ================= Admission & Course Details ================= --}}
                                        <h5 class="mb-4 mt-5">Admission & Course Details</h5>

                                        {{-- Admission Date --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Admission Date <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="date" name="admission_date"
                                                    class="form-control @error('admission_date') is-invalid @enderror"
                                                    value="{{ old('admission_date') }}" required>
                                                @error('admission_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Student Type --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Student Type <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="type"
                                                    class="form-select @error('type') is-invalid @enderror" required>
                                                    <option value="">Select Type</option>
                                                    <option value="regular"
                                                        {{ old('type') == 'regular' ? 'selected' : '' }}>Regular</option>
                                                    <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>
                                                        Online</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Course --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Course <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="course_id"
                                                    class="form-select @error('course_id') is-invalid @enderror" required>
                                                    <option value="">Select Course</option>
                                                    {{-- Loop courses here --}}
                                                </select>
                                                @error('course_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- ================= Fee & Shortlist ================= --}}
                                        <h5 class="mb-4 mt-5">Fee & Shortlist Details</h5>

                                        {{-- Shortlist Status --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Shortlist Status</label>
                                            <div class="col-sm-9">
                                                <select name="shortlist_status" class="form-select">
                                                    <option value="0">Not Shortlisted</option>
                                                    <option value="1">Shortlisted</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Fee Type --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Fee Type</label>
                                            <div class="col-sm-9">
                                                <select name="fee_type" class="form-select">
                                                    <option value="full">Full Fee</option>
                                                    <option value="installment">Installment</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- ================= Address & Notes ================= --}}
                                        <h5 class="mb-4 mt-5">Address & Notes</h5>

                                        {{-- Address --}}
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                                    placeholder="Enter full address">{{ old('address') }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Additional Notes --}}
                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Additional Notes</label>
                                            <div class="col-sm-9">
                                                <textarea name="additional_notes" class="form-control" rows="3" placeholder="Any additional information">{{ old('additional_notes') }}</textarea>
                                            </div>
                                        </div>

                                        {{-- ================= Status & Submit ================= --}}
                                        <h5 class="mb-4 mt-5">Status</h5>

                                        <div class="mb-4 row">
                                            <label class="col-sm-3 col-form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="status"
                                                    class="form-select @error('status') is-invalid @enderror">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    Submit Student
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
