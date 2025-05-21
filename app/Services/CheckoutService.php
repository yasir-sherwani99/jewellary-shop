<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ShippingMethodRepositoryInterface;
use App\Repositories\Interfaces\TaxRateRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use Carbon\Carbon;

class CheckoutService
{
    protected $user;
    protected $order;
    protected $shipping;
    protected $tax;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        ShippingMethodRepositoryInterface $shippingMethodRepository,
        TaxRateRepositoryInterface $taxRateRepository
    ) {
        $this->user = $userRepository;
        $this->order = $orderRepository;
        $this->shipping = $shippingMethodRepository;
        $this->tax = $taxRateRepository;
    }

    public function getShippingMethods()
    {
        return $this->shipping->getActiveShippingMethods();
    }

    public function getShippingPrice()
    {
        $shippingMethod = $this->shipping->getActiveShippingMethod();

        if(!$shippingMethod) {
            return 0;
        }

        return $shippingMethod->price;
    }

    public function calculateTax($subtotal)
    {
      //  $taxRate = TaxRate::forAddress($country)->first();
        $taxRate = $this->tax->getActiveTaxRate();
        if (!$taxRate) {
            return [
                'rate' => 0,
                'amount' => 0
            ];
        }

        return [
            'rate' => $taxRate->rate,
            'amount' => $subtotal * ($taxRate->rate / 100)
        ];
    }

    public function calculateTotals($subtotal)
    {
        $shippingPrice = $this->getShippingPrice();
        
        $tax = $this->calculateTax($subtotal);
        
        return [
            'subtotal' => $subtotal,
            'shipping' => $shippingPrice,
            'tax_rate' => $tax['rate'],
            'tax_amount' => round($tax['amount'], 2),
            'total' => round($subtotal + $shippingPrice + $tax['amount'], 2)
        ];
    }

    public function createOrder($data, $totals, $cart)
    {
        $user = null;
    
        if (Auth::check()) {
            // user is authenticated
            $user = Auth::user();

        } elseif ($data['create_account'] == "1") {
            
            // guest wants to create an account
            $user = $this->user->updateOrCreate(
                ['email' => $data['email']],
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'password' => $data['password']
                ]
            );

            Auth::login($user);
            
        } else {

            // no account creation
            $user = $this->user->updateOrCreate(
                ['email' => $data['email']],
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name']
                ]
            );

        }

        $orderId = Str::orderedUuid();

        $orderData = [
            'id' => $orderId,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => !empty($user) ? $user->id : null,
            'payment_method' => $data['payment_method'],
            'order_date' => Carbon::now()->format('Y-m-d'),
            'tracking_number' => null,
            'subtotal_amount' => $totals['subtotal'],
            'shipping_amount' => $totals['shipping'],
            'tax_amount' => $totals['tax_amount'],
            'discount_amount' => 0,
            'total_amount' => $totals['total'],
            'shipping_address_id' => null,
            'billing_address_id' => null,
            'notes' => $data['notes'],
            'status' => 'pending'
        ];

        // create order
        $this->order->create($orderData);
        
        // get order
        $order = $this->order->getOrderById($orderId);
        
        // store order items
        if(count($cart->items) > 0) {
            // add order items
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                    'customization_details' => null
                ]);
            }
        }

        // store order shipping addresses
        $order->addresses()->create([
            'order_id' => $orderId,
            'address_type' => 'shipping',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'street_address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'is_default' => 1,
        ]);

        return $order;
    }
}
