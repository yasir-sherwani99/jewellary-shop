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
}
