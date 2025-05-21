<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\CartItem;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class CartService
{
    protected $product;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->product = $productRepository;
    }

    public function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
        } else {
            $sessionId = session()->get('cart_session_id');
            if (!$sessionId) {
                $sessionId = Str::random(40);
                session()->put('cart_session_id', $sessionId);
            }
            
            $cart = Cart::firstOrCreate([
                'session_id' => $sessionId
            ]);
        }
        
        return $cart;
    }

    public function addItem($productId, $quantity = 1)
    {
        $cart = $this->getCart();
        // get product
        $product = $this->product->getProductById($productId);
        if(!$product) {
            abort(404);
        }

        $existingItem = $cart->items()->where('product_id', $productId)->first();

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + $quantity
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->discount_price ?? $product->price
            ]);
        }

        return $this->getCartWithItems();
    }

    public function removeItem($productId)
    {
        $cart = $this->getCart();
        $cart->items()->where('product_id', $productId)->delete();
        
        return $this->getCartWithItems();
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = $this->getCart();
        
        if ($quantity <= 0) {
            return $this->removeItem($productId);
        }

        $cart->items()
            ->where('product_id', $productId)
            ->update([
                'quantity' => $quantity
            ]);

        $updatedItem = $cart->items()->where('product_id', $productId)->first();
        
        // return $this->getCartWithItems();
        $productPrice = $updatedItem->discount_price ?? $updatedItem->price;

        return [
            'cart' => $cart,
            'subtotal' => round($productPrice * $updatedItem->quantity, 2),
            'total' => round($cart->total(), 2),
            'count' => $cart->items->sum('quantity')
        ];
    }

    public function getCartWithItems()
    {
        $cart = $this->getCart();
        $cart->load('items.product.images');
        
        return [
            'cart' => $cart,
            'total' => round($cart->total(), 2),
            'count' => $cart->items->sum('quantity')
        ];
    }

    public function getCartCount()
    {
        $cart = $this->getCart();

        return $cart->items()->sum('quantity');
    }

    public function getSubtotal()
    {
        $cart = $this->getCart();

        return $cart->items()->selectRaw('SUM(quantity * price) as total')->value('total') ?? 0;
    }

    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        
        return $this->getCartWithItems();
    }

    public function mergeGuestCartToUser($userId)
    {
        $sessionId = session()->getId();
        $guestCart = Cart::bySession($sessionId)->first();

        if ($guestCart && $guestCart->items()->count() > 0) {
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);

            // Move items from guest cart to user cart
            foreach ($guestCart->items as $item) {
                $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();

                if ($existingItem) {
                    $existingItem->update([
                        'quantity' => $existingItem->quantity + $item->quantity
                    ]);
                } else {
                    $userCart->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price
                    ]);
                }
            }

            // Delete guest cart
            $guestCart->delete();
        }
    }
}
