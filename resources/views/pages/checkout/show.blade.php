@extends('layouts.app')

@section('content')

    @include('common.page-header', ['title' => 'Checkout', 'subTitle' => ''])

    {{-- @include('common.breadcrumb', ['section' => 'Shopping', 'page' => 'Checkout']) --}}

    <div class="page-content mt-4">
        <div class="checkout">
            <div class="container">
                <!-- <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div> -->
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
                @if(session()->has('error'))
                    <div class="alert alert-danger border-0 alert-dismissible fade show mb-2" role="alert">
                        <strong>Woops!</strong> {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Contact Information</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="email" class="text-dark font-weight-normal">Email<span class="text-danger ml-2">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" />
                                </div>
                            </div>
                            <h2 class="checkout-title">Shipping Address</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="country" class="text-dark font-weight-normal">Country<span class="text-danger ml-2">*</span></label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="pakistan">Pakistan</option>
                                        <option value="india">India</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="first_name" class="text-dark font-weight-normal">First Name<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First Name" />
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="last_name" class="text-dark font-weight-normal">Last Name<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" />
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="address" class="text-dark font-weight-normal">Address<span class="text-danger ml-2">*</span></label>
                                    <input type="text" name="address" id="address"  class="form-control" value="{{ old('address') }}" placeholder="Address" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="city" class="text-dark font-weight-normal">City<span class="text-danger ml-2">*</span></label>
                                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}" placeholder="City" />
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="state" class="text-dark font-weight-normal">Province / State<span class="text-danger ml-2">*</span></label>
                                    <input type="text" id="state" name="state" class="form-control" value="{{ old('state') }}" placeholder="Province or state" />
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="postal_code" class="text-dark font-weight-normal">Postal Code (optional)</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{ old('postal_code') }}" placeholder="Postal code (optional)" />
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="phone" class="text-dark font-weight-normal">Phone<span class="text-danger ml-2">*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"  placeholder="Phone" />
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            @if(!auth()->check())
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="custom-control custom-checkbox mt-1">
                                            <input 
                                                type="checkbox" 
                                                class="custom-control-input account_creation" 
                                                name="create_account" 
                                                id="checkout-create-acc" 
                                                value="1" 
                                                onchange="toggleAccountCreation()"
                                                {{ old('create_account') == '1' ? 'checked' : '' }}
                                            />
                                            <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div>
                                </div>

                                <div class="row {{ old('create_account') ? 'd-block' : 'd-none' }}" id="password_section">
                                    <div class="col-sm-6">
                                        <label for="password" class="text-dark font-weight-normal">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                                        <small>Password must be atleast 6 characters or more.</small>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label for="password_confirmation" class="text-dark font-weight-normal">Confirm Password<span class="text-danger ml-2">*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="text-dark font-weight-normal">Order Notes (optional)</label>
                                    <textarea class="form-control" cols="30" rows="4" name="notes" placeholder="Notes about your order, e.g. special notes for delivery">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <h2 class="checkout-title">Payment</h2>
                            <div class="row">
	                			<div class="col-sm-12">
                                    <div class="custom-control custom-radio mt-0">
                                        <input type="radio" name="payment_method" value="cod" class="custom-control-input" checked />
                                        <label class="custom-control-label text-dark font-weight-normal">
                                            Cash on Delivery
                                            <p>You can pay the money at the time of delivery.</p>
                                        </label>
                                    </div><!-- End .custom-control -->                                
                                </div>
                            </div>
                            <div class="row mt-4">
	                			<div class="col-sm-12">
                                    <button type="submit" class="btn btn-outline-primary-2 btn-round btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Place Order</span>
                                    </button>
                                </div>
                            </div>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Order Summary</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(count($cart['cart']->items) > 0)
                                            @foreach($cart['cart']->items as $item)
                                                <tr>
                                                    <td>
                                                        <a href="#">{{ $item->product->name }}</a>
                                                        <p>
                                                            <small>{{ 'Rs. ' . $item->price }} x {{ $item->quantity }}</small>
                                                        </p>
                                                    </td>
                                                    <td>Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr class="summary-subtotal">
                                            <td>Subtotal :</td>
                                            <td>Rs. {{ $totals['subtotal'] }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Tax ({{ $totals['tax_rate'] . ' %' }}) :</td>
                                            <td>Rs. {{ $totals['tax_amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping :</td>
                                            <td>Rs. {{ $totals['shipping'] }}</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total :</td>
                                            <td>Rs. {{ $totals['total'] }}</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        function toggleAccountCreation()
        {
            if($('.account_creation').is(":checked")) {
                $("#password_section").removeClass('d-none');
            } else {
                $("#password_section").addClass('d-none');
            }
        }
    </script>

@endsection