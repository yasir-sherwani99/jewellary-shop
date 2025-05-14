<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;

use Carbon\Carbon;

class SupportController extends Controller
{
    protected $contact;

    public function __construct(
        ContactRepositoryInterface $contactRepository
    ) {
        $this->contact = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.support.index');
    }

    public function getNewMessages()
    {
        $msgArray = [];
        $messages = $this->contact->getUnreadMsgs();

        if(count($messages) > 0) {
            foreach($messages as $key => $msg) {
                $msgArray[] = [
                    'id' => $msg->id,
                    'user' => $msg->name,
                    'subject' => $msg->subject,
                    'status' => $msg->is_read,
                    'date' => Carbon::parse($msg->created_at)->toFormattedDateString(),
                    'details' => $msg->id
                ];
            }
        }

        return json_encode($msgArray);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get support ticket
        $ticket = $this->contact->find($id);
        if(!isset($ticket) || empty($ticket)) {
    		abort(404);
    	}

        // set message as read
        $this->contact->update(['is_read' => 1], $ticket->id);

        return view('pages.admin.support.show', [
            'ticket' => $ticket
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function log()
    {
        return view('pages.admin.support.log');
    }

    public function getAllMessages()
    {
        $msgArray = [];
        $messages = $this->contact->getAllMessages();

        if(count($messages) > 0) {
            foreach($messages as $key => $msg) {
                $msgArray[] = [
                    'id' => $msg->id,
                    'user' => $msg->name,
                    'subject' => $msg->subject,
                    'status' => $msg->is_read,
                    'date' => Carbon::parse($msg->created_at)->toFormattedDateString(),
                    'details' => $msg->id
                ];
            }
        }

        return json_encode($msgArray);
    }
}
