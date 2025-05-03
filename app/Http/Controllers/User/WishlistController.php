<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Interfaces\WishlistRepositoryInterface;

class WishlistController extends Controller
{
    protected $wishlist;

    public function __construct(WishlistRepositoryInterface $wishlistRepository)
    {
        $this->wishlist = $wishlistRepository;
    }

    public function show()
    {
        $userId = Auth::id();
        $wishlists = $this->wishlist->getUserWishlistProducts($userId);

        return view('pages.wishlist.show', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');
        
        $wishlist = $this->wishlist->getUserWishlistByProductId($userId, $productId);

        if ($wishlist) {
            
            $wishlist->delete();
            $status = 'removed';
        
        } else {

            $data = [
                'user_id' => $userId,
                'product_id' => $productId
            ];

            $this->wishlist->create($data);
            $status = 'added';
        }

        $wishlistCount = $this->wishlist->countUserWishlist($userId);

        return response()->json([
            'success' => true,
            'status' => $status,
            'wishlist_count' => $wishlistCount
        ], 200);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $userId = Auth::id();

        $wishlist = $this->wishlist->getUserWishlistByProductId($userId, $request->product_id);

        if ($wishlist) {   
            $wishlist->delete();
        }

        $wishlistCount = $this->wishlist->countUserWishlist($userId);

        return response()->json([
            'success' => true,
            'message' => 'Well Done! Product removed from wishlist successfully.',
            'wishlist_count' => $wishlistCount
        ], 200);
    }
}
