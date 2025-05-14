<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    protected $admin;

    /**
     * Create a new class instance.
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function find($id): ?\App\Models\Admin
    {
        return $this->admin->find($id);
    }

    public function getAdminById($adminId): ?\App\Models\Admin
    {
        return $this->admin->find($adminId);
    }

    public function create($data): \App\Models\Admin
    {
        return $this->admin->create($data);
    }

    public function update($data, $adminId): bool
    {
        $adminn = $this->find($adminId);

        return $adminn ? $adminn->update($data) : false;
    }

    public function getAllAdmins(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->admin->get();
    }
}
