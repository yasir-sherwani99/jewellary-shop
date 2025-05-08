<?php

namespace App\Repositories\Interfaces;

interface OrderItemRepositoryInterface
{
    public function last7DaysSales(): \Illuminate\Support\Collection;
}
