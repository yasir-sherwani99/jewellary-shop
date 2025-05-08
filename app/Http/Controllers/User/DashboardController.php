<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\WishlistRepositoryInterface;

class DashboardController extends Controller
{
    protected $user;
    protected $order;
    protected $wishlist;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        WishlistRepositoryInterface $wishlistRepository
    ) {
        $this->user = $userRepository;
        $this->order = $orderRepository;
        $this->wishlist = $wishlistRepository;
    }

    /**
     * Show the user dashboard page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];

        $data['user'] = $this->user->getUserById(Auth::id());
        $data['orders'] = $this->order->getUserOrders(Auth::id());
        $data['wishlists'] = $this->wishlist->getUserWishlistProducts(Auth::id());

        return view('pages.dashboard.index', compact('data'));
    }
}
