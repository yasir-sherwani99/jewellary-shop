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

    public function getAllUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->user
                    ->withCount('orders')
                    ->sort('desc')
                    ->get();
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

    public function getUsersStats(): array 
    {
        return [
            'total_users' => $this->user->count(),
            'register_users' => $this->user->whereNotNull('password')->count()
        ];
    }

    public function countMonthWiseUsers($datesData): array
    {
        $userArr = [];
        foreach($datesData as $data) {
            // count month wise users 
            $users = $this->user
                        ->whereMonth('created_at', $data['month'])
                        ->whereYear('created_at', $data['year'])
                        ->count();
            
            array_push($userArr, $users);
        }

		return $userArr;
    }
}
