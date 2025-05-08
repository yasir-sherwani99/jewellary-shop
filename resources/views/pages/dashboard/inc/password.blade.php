<form action="{{ route('password.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf
    <div class="row mb-1">
        <div class="col-sm-12">
            <label for="current_password">Current password "</label>
            <input type="password" name="current_password" id="current_password" value="{{ old('current_password') }}" class="form-control mb-0" required />
            <div class="invalid-feedback">
                This is a required field.
            </div>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-sm-12">
            <label for="password">New password *</label>
            <input type="password" name="password" id="password" class="form-control mb-0" required />
            <small class="text-muted">Password must be 6 characters or greater</small>
            <div class="invalid-feedback">
                This is a required field.
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-12">
            <label for="password_confirmation">Confirm new password *</label>
            <input type="password" name="passwordConfirmation" id="password_confirmation" class="form-control mb-0" required />
            <div class="invalid-feedback">
                This is a required field.
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-outline-primary-2">
        <span>SAVE CHANGES</span>
        <i class="icon-long-arrow-right"></i>
    </button>
</form>