<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function find($id): ?\App\Models\User;
    public function getUserById($userId): ?\App\Models\User;
    public function getUserByEmail($email): ?\App\Models\User;
    public function updateOrCreate($attributes, $values): ?\App\Models\User;
    public function create($data): int;
    public function update($data, $userId): bool;
}
