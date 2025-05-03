<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use Illuminate\Http\Request;

use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    protected $wishlist;

    public function __construct(
        CartService $cartService,
        WishlistRepositoryInterface $wishlistRepository
    ) {
        $this->cartService = $cartService;
        $this->wishlist = $wishlistRepository;
    }

    public function index()
    {
        $cartData = $this->cartService->getCartWithItems();
        
        return view('pages.cart.index', compact('cartData'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $cartData = $this->cartService->addItem(
            $request->product_id,
            $request->quantity ?? 1
        );

        return response()->json([
            'success' => true,
            'count' => $cartData['count'],
            'total' => $cartData['total'],
            'message' => 'Product added to cart'
        ], 200);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cartData = $this->cartService->removeItem($request->product_id);

        return response()->json([
            'success' => true,
            'count' => $cartData['count'],
            'total' => $cartData['total'],
            'message' => 'Product removed from cart successfully.'
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartData = $this->cartService->updateQuantity(
            $request->product_id,
            $request->quantity
        );

        return response()->json([
            'success' => true,
            'count' => $cartData['count'],
            'subtotal' => $cartData['subtotal'],
            'total' => $cartData['total'],
            'message' => 'Cart updated successfully.'
        ], 200);
    }

    public function getCart()
    {
        $wishlistCount = 0;

        $cartData = $this->cartService->getCartWithItems();
        
        if(Auth::check()) {
            $wishlistCount = $this->wishlist->countUserWishlist(Auth::id());
        }
        
        return response()->json([
            'success' => true,
            'cart' => $cartData['cart'],
            'count' => $cartData['count'],
            'total' => $cartData['total'],
            'wishlist_count' => $wishlistCount
        ], 200);
    }

    public function clear()
    {
        $cartData = $this->cartService->clearCart();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
            'count' => $cartData['count'],
            'total' => $cartData['total']
        ], 200);
    }
}
