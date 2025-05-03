<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    /**
     * Create a new class instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserById($userId): ?\App\Models\User
    {
        return $this->user->find($userId);
    }

    public function create($data): int
    {
        $this->user->create($data);

        $id = DB::getPdo()->lastInsertId();
        
        return $id;
    }
}
