<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutProcessRequest;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\OrderRepositoryInterface;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $checkoutService;
    protected $order;

    public function __construct(
        CartService $cartService,
        CheckoutService $checkoutService,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
        $this->order = $orderRepository;
    }

    public function show()
    {
        $cart = $this->cartService->getCartWithItems();
        if(count($cart['cart']->items) == 0) {
            return redirect()
                    ->back()
                    ->withErrors(['error' => 'Woops! Your cart is empty.'])
                    ->withInput();
        }

        $subtotal = $this->cartService->getSubtotal();
        // shipping type i.e. free, standard or express
        $shippingType = 'free';
        // tax country
        $country = "Pakistan";

        $totals = $this->checkoutService->calculateTotals($subtotal,  $shippingType, $country);
        
        return view('pages.checkout.show', [
            'cart' => $cart,
            'totals' => $totals
        ]);
    }

    public function processCheckout(CheckoutProcessRequest $request)
    {
        // get user cart
        $cart = $this->cartService->getCartWithItems();
        if(count($cart['cart']->items) == 0) {
            return redirect()
                    ->back()
                    ->withErrors(['error' => 'Woops! Your cart is empty.'])
                    ->withInput();
        }
     
        $subtotal = $this->cartService->getSubtotal();

        // shipping type i.e. free, standard or express
        $shippingType = 'free';
        // tax country
        $country = "Pakistan";

        $totals = $this->checkoutService->calculateTotals($subtotal,  $shippingType, $country);
        // create order
        $order = $this->checkoutService->createOrder($request, $totals, $cart['cart']);

        // clear the cart
        $this->cartService->clearCart();

        // store order ID in session for success page
        session()->put('last_order_id', $order->id);

        // Send order confirmation email
        // $order->notify(new OrderConfirmation($order, $isNewUser));

        // redirect to confirmation page
        return redirect()->route('checkout.complete');
    }

    public function checkoutComplete()
    {
        $orderId = session()->get('last_order_id');
        
        if (!$orderId) {
            return redirect()->route('home');
        }
        
        $order = $this->order->getOrderById($orderId);
        
        return view('pages.confirmation.index', compact('order'));
    }
}
