@extends('layouts.app')

@section('content')

    @include('common.page-header', ['title' => 'Shopping Cart', 'subTitle' => ''])

    <div class="page-content mt-4">
        <div class="cart">
	        <div class="container">
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
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th class="text-dark font-weight-normal">Product</th>
                                    <th class="text-dark font-weight-normal">Price</th>
                                    <th class="text-dark font-weight-normal">Quantity</th>
                                    <th class="text-dark font-weight-normal">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="cart-items">
                                @if(count($cartData['cart']->items) > 0)
                                    @foreach($cartData['cart']->items as $item)
                                        <tr class="cart-item" data-item-id="{{ $item->id }}">
                                            <td class="product-col">
                                                <div class="product">
                                                    @if(count($item->product->images) > 0)
                                                        @foreach($item->product->images as $img)
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img src="{{ $img->image_url }}" alt="{{ $item->product->name }}" />
                                                                </a>
                                                            </figure>
                                                            @break
                                                        @endforeach
                                                    @endif
                                                    <h3 class="product-title">
                                                        <a href="#">{{ $item->product->name }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col">Rs. {{ $item->price }}</td>
                                            <td class="quantity-col">
                                                <div class="input-spinner">
                                                    <button class="btn-spinner decrement-qty">
                                                        <i class="icon-minus"></i>
                                                    </button>
                                                    <input 
                                                        type="number" 
                                                        class="form-control quantity-input text-center pl-4" 
                                                        value="{{ $item->quantity }}" 
                                                        min="1" 
                                                        max="10"
                                                        readonly
                                                        data-product-id="{{ $item->product->id }}"
                                                    >
                                                    <button class="btn-spinner increment-qty">
                                                        <i class="icon-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="total-col">
                                                Rs. <span class="subtotal">{{ round($item->price * $item->quantity, 2) }}</span>
                                            </td>
                                            <td class="remove-col remove-cart-item" data-product-id="{{ $item->product->id }}">
                                                <button class="btn-remove"><i class="icon-close"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="cart-summary">
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p>Your cart is empty!</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Summary</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td class="w-50">Subtotal:</td>
                                        <td class="cart-total w-50">Rs. {{ $cartData['total'] }}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping-estimate">
                                        <td colspan="2">
                                            <small class="text-muted">Shipping and tax calculated at checkout.</small>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td class="w-50">Subtotal:</td>
                                        <td class="cart-total w-50">Rs. {{ $cartData['total'] }}</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            @if(count($cartData['cart']->items) > 0)
                                <a 
                                    href="{{ route('checkout.show') }}" 
                                    class="btn btn-outline-primary-2 btn-order btn-block"
                                >
                                    PROCEED TO CHECKOUT
                                </a>
                            @endif 
                        </div><!-- End .summary -->

                        <a 
                            href="{{ route('product.collection') }}" 
                            class="btn btn-outline-dark-2 btn-block mb-3"
                        >
                            <span>CONTINUE SHOPPING</span>
                            <i class="icon-refresh"></i>
                        </a>
                    </aside><!-- End .col-lg-3 -->
                </div>
            </div>
        </div>
    </div>
    
@endsection