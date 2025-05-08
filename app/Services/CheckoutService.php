<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\TaxRate;
use App\Models\ShippingMethod;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    protected $user;
    protected $order;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->user = $userRepository;
        $this->order = $orderRepository;
    }

    public function getShippingMethods()
    {
        return ShippingMethod::active()->get();
    }

    public function getShippingPrice($type = 'free')
    {
        $shippingMethod = ShippingMethod::shippingtype($type)->first();

        if(!$shippingMethod) {
            return 0;
        }

        return $shippingMethod->price;
    }

    public function calculateTax($subtotal, $country)
    {
        $taxRate = TaxRate::forAddress($country)->first();
        
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

    public function calculateTotals($subtotal, $shippingType, $country)
    {
        $shippingPrice = $this->getShippingPrice($shippingType);
        
        $tax = $this->calculateTax($subtotal, $country);
        
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

        // add shipping address
        $shipping = $order->shippingAddress()->create([
                        'user_id' => !empty($user) ? $user->id : null,
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'address_type' => 'shipping',
                        'street_address' => $data['address'],
                        'city' => $data['city'],
                        'state' => $data['state'],
                        'postal_code' => $data['postal_code'],
                        'country' => $data['country'],
                        'is_default' => 1,
                    ]);

        // update order shipping_address_id
        $this->order->update(['shipping_address_id' => $shipping->id], $orderId);

        return $order;
    }
}
