<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contact = $contactRepository;
    }

    public function create()
    {
        return view('pages.contact.create');
    }

    public function store(ContactStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => 0
        ];

        $this->contact->create($data);

        return redirect()->route('contact.create')
                         ->with('success', 'Your request has been submitted successfully.');
    }
}
