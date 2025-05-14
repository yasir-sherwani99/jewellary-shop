<?php

namespace App\Repositories\Interfaces;

interface ContactRepositoryInterface
{
    public function find($id): ?\App\Models\Contact;
    public function create($data): ?\App\Models\Contact;
    public function update($data, $ticketId): bool;
    public function getUnreadMsgs(): \Illuminate\Database\Eloquent\Collection;
    public function getAllMessages(): \Illuminate\Database\Eloquent\Collection;
}
