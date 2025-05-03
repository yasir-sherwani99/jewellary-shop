<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name<span class="text-danger ml-2">*</span></label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required />
            </div><!-- End .form-group -->
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name<span class="text-danger ml-2">*</span></label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required />
            </div><!-- End .form-group -->
        </div>
    </div>
    <div class="form-group">
        <label for="register-email">Email<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control" id="register-email" name="email" value="{{ old('email') }}" required />
    </div><!-- End .form-group -->

    <div class="form-group">
        <label for="register-password">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control" id="register-password" name="password" required />
        <small>
    </div><!-- End .form-group -->
    
    <div class="form-group">
        <label for="confirm-password">Confirm Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control" id="confirm-password" name="passwordConfirmation" required />
    </div><!-- End .form-group -->

    <div class="form-footer">
        <button type="submit" class="btn btn-outline-primary-2">
            <span>SIGN UP</span>
            <i class="icon-long-arrow-right"></i>
        </button>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="register-policy-2" required />
            <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
        </div><!-- End .custom-checkbox -->
    </div><!-- End .form-footer -->
</form>
<div class="form-choice">
    <p class="text-center">or sign up with</p>
    <div class="row">
        <div class="col-sm-6">
            <a href="#" class="btn btn-login btn-g">
                <i class="icon-google"></i>
                Login With Google
            </a>
        </div><!-- End .col-6 -->
        <div class="col-sm-6">
            <a href="#" class="btn btn-login  btn-f">
                <i class="icon-facebook-f"></i>
                Login With Facebook
            </a>
        </div><!-- End .col-6 -->
    </div><!-- End .row -->
</div><!-- End .form-choice -->