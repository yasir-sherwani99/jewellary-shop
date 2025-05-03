<div class="form-box">
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="form-tab">
        <ul class="nav nav-pills nav-fill" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ request()->is('login') ? 'show active' : '' }}" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                @include('auth.inc.login-form')  
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade {{ request()->is('register') ? 'show active' : '' }}" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                @include('auth.inc.register-form')
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .form-tab -->
</div><!-- End .form-box -->