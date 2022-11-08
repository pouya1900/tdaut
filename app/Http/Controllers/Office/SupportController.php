<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\supportMessageRequest;
use App\Http\Requests\supportStoreRequest;
use App\Models\Office;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office)
    {
        $data = [];
        foreach ($office->supports as $support) {
            $data[] = [
                'title'      => $support->title,
                'created_at' => date('Y-m-d H:i', strtotime($support->created_at)),
                'status'     => view('office.includes.status', ['status' => $support->status])->render(),
                'action'     => view('office.includes.action', ['show' => route('mg.support_show', ['office' => $office->id, 'support' => $support->id])])->render(),
            ];
        }

        return view('office.supports.index', compact('office', 'data'));
    }

    public function show(Office $office, Support $support)
    {
        return view('office.supports.show', compact('office', 'support'));
    }

    public function store_message(supportMessageRequest $request, Office $office, Support $support)
    {
        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));
    }

    public function create(Office $office)
    {
        return view('office.supports.create', compact('office'));
    }

    public function store(supportStoreRequest $request, Office $office)
    {
        $support = $office->supports()->create([
            'title' => $request->input('title'),
        ]);

        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));

    }


}
