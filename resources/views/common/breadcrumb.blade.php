<nav aria-label="breadcrumb" class="breadcrumb-nav border-bottom-1 mb-2">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            @if(isset($section))
                <li class="breadcrumb-item"><a href="#">{{ $section }}</a></li>
            @endif
            @if(isset($page))
                <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
            @endif
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->