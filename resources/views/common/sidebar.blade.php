<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-wishlist" role="tab" aria-controls="tab-wishlist" aria-selected="false">Wishlist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false">Password</a>
    </li>
    <li class="nav-item">
        <a 
            href="#"
            class="nav-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            Sign Out
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</ul>