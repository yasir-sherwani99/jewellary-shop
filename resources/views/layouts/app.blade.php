<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials.app._head')

<body>
     <!-- preloader start -->
     @include('layouts.partials._loader')
    <div class="page-wrapper">
        <header class="header header-25">
            @include('layouts.partials.app._header_top')
            @include('layouts.partials.app._header_middle')
            @include('layouts.partials.app._header_bottom')
        </header>
        <main class="main">
            @yield('content')
        </main>
        @include('layouts.partials.app._footer')
    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    @include('layouts.partials.app._mobile_menu')
    <!-- Sign in / Register Modal -->
    @include('modals.signin-modal')
    <!-- @include('modals.newsletter') -->

    @if(request()->is('collections') || request()->is('collection/best-selling'))
        @vite(['resources/js/collection.js'])
    @else
        @vite(['resources/js/app.js'])
    @endif
    @yield('script')
</body>
</html>
