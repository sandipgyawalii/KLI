<h5 class="mt-5 mb-4">Status</h5>

<div class="mb-4 row">
    <label class="col-sm-3 col-form-label">
        Status <span class="text-danger">*</span>
    </label>

    <div class="col-sm-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('status') is-invalid @enderror"
                   type="radio"
                   name="status"
                   id="status_active"
                   value="1"
                   {{ old('status', $data['row']->status ?? '1') == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="status_active">Active</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input @error('status') is-invalid @enderror"
                   type="radio"
                   name="status"
                   id="status_inactive"
                   value="0"
                   {{ old('status', $data['row']->status ?? '1') == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="status_inactive">Inactive</label>
        </div>

        @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
