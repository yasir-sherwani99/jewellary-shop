<?php

namespace App\Repositories;

use App\Models\Wishlist;
use App\Repositories\Interfaces\WishlistRepositoryInterface;

class WishlistRepository implements WishlistRepositoryInterface
{
    protected $wishlist;

    /**
     * Create a new class instance.
     */
    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function find($id): ?Wishlist
    {
        return $this->wishlist->find($id);
    }

    public function getUserWishlistProducts($userId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->wishlist->with('product.images')->where('user_id', $userId)->get();
    }

    public function getUserWishlistByProductId($userId, $productId): ?Wishlist
    {
        return $this->wishlist->where('user_id', $userId)->where('product_id', $productId)->first();
    }

    public function countUserWishlist($userId): int
    {
        return $this->wishlist->where('user_id', $userId)->count();
    }

    public function create($data): Wishlist
    {
        return $this->wishlist->create($data);
    }

    public function delete($wislistId): bool
    {
        $wlist = $this->find($wislistId);

        return $wlist ? $wlist->delete() : false;
    }
}
