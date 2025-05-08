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

    public function find($id): ?\App\Models\User
    {
        return $this->user->find($id);
    }

    public function getUserById($userId): ?\App\Models\User
    {
        return $this->user->find($userId);
    }

    public function getUserByEmail($email): ?\App\Models\User
    {
        return $this->user->where('email', $email)->first();
    }

    public function updateOrCreate($attributes, $values): ?\App\Models\User
    {
        return $this->user->updateOrCreate($attributes, $values);
    }

    public function create($data): int
    {
        $this->user->create($data);

        $id = DB::getPdo()->lastInsertId();
        
        return $id;
    }

    public function update($data, $userId): bool
    {
        $userr = $this->find($userId);

        return $userr ? $userr->update($data) : false;
    }
}
