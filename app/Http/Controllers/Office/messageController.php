<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class messageController extends Controller
{

    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office, User $user = null)
    {

        $users = $office->connect_users()->orderBy('messages.created_at', 'desc')->get()->unique('id');

        $default_user = $user;

        if (!$default_user) {
            $default_user = $users->first();
        }

        if ($default_user) {
            $messages = $office->messages()->where('user_id', $default_user->id)->orderBy('created_at', 'asc')->get();
        } else {
            $messages = [];
        }
        return view('office.messages.index', compact('office', 'users', 'default_user', 'messages'));
    }

    public function store(Office $office, User $user)
    {
        try {
            $message = $this->request->input('message');

            $office->messages()->create([
                'user_id' => $user->id,
                'sender'  => 'office',
                'text'    => $message,
            ]);

            return redirect(route('mg.messages', ['office' => $office->id, 'user' => $user->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
