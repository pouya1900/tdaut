<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\supportMessageRequest;
use App\Http\Requests\supportStoreRequest;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;

class supportController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $user = $this->request->current_user;
        $data = [];
        foreach ($user->supports as $support) {
            $data[] = [
                'title'      => $support->title,
                'created_at' => date('Y-m-d H:i', strtotime($support->created_at)),
                'status'     => view('front.partials.status', ['status' => $support->status])->render(),
                'action'     => view('front.partials.action', ['show' => route('user_support_show', ['support' => $support->id])])->render(),
            ];
        }
        return view('front.users.supports.index', compact('user', 'data'));
    }

    public function show(Support $support)
    {
        $user = $this->request->current_user;

        if ($support->supportable != $user) {
            abort(403);
        }

        return view('front.users.supports.show', compact('user', 'support'));
    }

    public function store_message(supportMessageRequest $request, Support $support)
    {
        $user = $this->request->current_user;

        if ($support->supportable != $user) {
            abort(403);
        }
        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('user_support_show', ['support' => $support->id]));
    }

    public function create()
    {
        $user = $this->request->current_user;
        return view('front.users.supports.create', compact('user'));
    }

    public function store(supportStoreRequest $request)
    {
        $user = $this->request->current_user;

        $support = $user->supports()->create([
            'title' => $request->input('title'),
        ]);

        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('user_support_show', ['support' => $support->id]));

    }
}
