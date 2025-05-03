<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials._head')

<body>
    <div class="page-wrapper">
        <header class="header header-25">
            @include('layouts.partials._header_top')
            @include('layouts.partials._header_middle')
            @include('layouts.partials._header_bottom')
        </header>
        <main class="main">
            @yield('content')
        </main>
        @include('layouts.partials._footer')
    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    @include('layouts.partials._mobile_menu')
    <!-- Sign in / Register Modal -->
    @include('modals.signin-modal')
    <!-- @include('modals.newsletter') -->

    @vite(['resources/js/app.js'])
    @yield('script')
</body>
</html>
