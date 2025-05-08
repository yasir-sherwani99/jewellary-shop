<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
    @csrf
    <div class="form-group">
        <label for="singin-email-2">Email<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control" id="singin-email-2" name="email" value="{{ old('email') }}" required />
        <div class="invalid-feedback">
            This is a required field.
        </div>
    </div><!-- End .form-group -->

    <div class="form-group">
        <label for="singin-password-2">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control" id="singin-password-2" name="password" required />
        <div class="invalid-feedback">
            This is a required field.
        </div>
    </div><!-- End .form-group -->

    <div class="form-footer">
        <button type="submit" class="btn btn-outline-primary-2">
            <span>LOG IN</span>
            <i class="icon-long-arrow-right"></i>
        </button>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="signin-remember-2">
            <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
        </div><!-- End .custom-checkbox -->

        <a href="#" class="forgot-link">Forgot Your Password?</a>
    </div><!-- End .form-footer -->
</form>
<div class="form-choice">
    <p class="text-center">or sign in with</p>
    <div class="row">
        <div class="col-sm-6">
            <a href="#" class="btn btn-login btn-g">
                <i class="icon-google"></i>
                Login With Google
            </a>
        </div><!-- End .col-6 -->
        <div class="col-sm-6">
            <a href="#" class="btn btn-login btn-f">
                <i class="icon-facebook-f"></i>
                Login With Facebook
            </a>
        </div><!-- End .col-6 -->
    </div><!-- End .row -->
</div><!-- End .form-choice -->