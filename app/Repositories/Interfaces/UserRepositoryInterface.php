<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUserById($userId): ?\App\Models\User;
    public function create($data): int;
}
