<?php

namespace App\Repositories\Interfaces;

interface ContactRepositoryInterface
{
    public function find($id): ?\App\Models\Contact;
    public function create($data): ?\App\Models\Contact;
}
