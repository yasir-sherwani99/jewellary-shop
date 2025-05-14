<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    protected $contact;

    /**
     * Create a new class instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function find($id): ?Contact
    {
        return $this->contact->find($id);
    }

    public function create($data): Contact
    {
        return $this->contact->create($data);
    }

    public function update($data, $ticketId): bool
    {
        $message = $this->find($ticketId);

        return $message ? $message->update($data) : false;
    }

    public function getUnreadMsgs(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->contact->unread()->get();
    }

    public function getAllMessages(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->contact->get();
    }
}
