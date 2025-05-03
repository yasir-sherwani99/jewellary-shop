@extends('layouts.app')

@section('content')

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
        <div class="container">
            @include('auth.inc.auth-section')
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->

@endsection
