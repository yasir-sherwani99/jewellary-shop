<?php

namespace App\Repositories\Interfaces;

interface AdminRepositoryInterface
{
    public function find($id): ?\App\Models\Admin;
    public function getAdminById($adminId): ?\App\Models\Admin;
    public function create($data): \App\Models\Admin;
    public function update($data, $adminId): bool;
    public function getAllAdmins(): \Illuminate\Database\Eloquent\Collection;
}
