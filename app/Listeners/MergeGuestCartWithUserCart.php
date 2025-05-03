<?php

namespace App\Listeners;

use App\Services\CartService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MergeGuestCartWithUserCart
{
    protected $cartService;

    /**
     * Create the event listener.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->cartService->mergeGuestCartToUser($event->user->id);
    }
}
