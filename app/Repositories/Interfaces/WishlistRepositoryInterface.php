<?php

namespace App\Repositories\Interfaces;

interface WishlistRepositoryInterface
{
    public function find($id): ?\App\Models\Wishlist;
    public function getUserWishlistProducts($userId): \Illuminate\Database\Eloquent\Collection;
    public function getUserWishlistByProductId($userId, $productId): ?\App\Models\Wishlist;
    public function countUserWishlist($userId): int;
    public function create($data): \App\Models\Wishlist;
    public function delete($wislistId): bool;
}
