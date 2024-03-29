<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Office $office = null)
    {
        $user = $this->request->current_user;
        $offices = $user->connect_offices()->orderBy('messages.created_at', 'desc')->get()->unique('id');

        $default_office = $office;

        if (!$default_office) {
            $default_office = $offices->first();
        }

        if ($default_office) {
            $messages = $user->messages()->where('office_id', $default_office->id)->orderBy('created_at', 'asc')->get();
        } else {
            $messages = [];
        }


        return view('front.users.messages.index', compact('offices', 'user', 'default_office', 'messages'));
    }

    public function store(Office $office)
    {
        try {
            $user = $this->request->current_user;

            $message = $this->request->input('message');

            $user->messages()->create([
                'office_id' => $office->id,
                'sender'    => 'user',
                'text'      => $message,
            ]);

            return redirect(route('user_messages', ['office' => $office->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
