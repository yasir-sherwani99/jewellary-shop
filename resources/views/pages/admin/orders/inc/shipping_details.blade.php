@if($address)
    <address class="mt-3">
        <i>{{ $address->first_name }}&nbsp;{{ $address->last_name }}</i><br />
        {{ $address->street_address }}<br />
        {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}<br />
        {{ $address->country }}<br />
        {{ $address->phone }}
    </address>
@else
    <address class="mt-3">
        <p>Shipping details not available.</p>
    </address>
@endif