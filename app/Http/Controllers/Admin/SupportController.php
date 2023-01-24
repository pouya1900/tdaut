<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\supportMessageRequest;
use App\Models\Administrator;
use App\Models\Office;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index($type)
    {
        $admin = $this->request->admin;

        if (!in_array($type, ['user', 'office'])) {
            abort(404);
        }

        if ($type == 'user') {
            $supports = Support::where('supportable_type', User::class)->get();
        } else {
            $supports = Support::where('supportable_type', Office::class)->get();
        }


        $data = [];
        foreach ($supports as $support) {
            $data[] = [
                'name'       => $type == 'user' ? $support->supportable->profile->fullName : $support->supportable->name,
                'title'      => $support->title,
                'created_at' => date('Y-m-d H:i', strtotime($support->created_at)),
                'status'     => view('front.partials.status', ['status' => $support->status])->render(),
                'action'     => view('front.partials.action', ['show' => route('admin.support.show', ['support' => $support->id])])->render(),
            ];
        }

        return view('admin.supports.index', compact('admin', 'data'));

    }

    public function show(Support $support)
    {
        $admin = $this->request->admin;

        if ($support->supportable instanceof User) {
            $user = $support->supportable;
            $office = null;
        } else {
            $user = null;
            $office = $support->supportable;
        }

        return view('admin.supports.show', compact('support', 'admin', 'user', 'office'));
    }

    public function store_message(supportMessageRequest $request, Support $support)
    {
        $admin = $this->request->admin;

        $support->messages()->create([
            'sender'   => 'admin',
            'admin_id' => $admin->id,
            'text'     => $request->input('message'),
        ]);

        $support->update([
            'status' => 'answered',
        ]);

        return redirect(route('admin.support.show', ['support' => $support->id]));
    }

}
