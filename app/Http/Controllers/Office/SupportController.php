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
                'status'     => view('front.partials.status', ['status' => $support->status])->render(),
                'action'     => view('front.partials.action', ['show' => route('mg.support_show', ['office' => $office->id, 'support' => $support->id])])->render(),
            ];
        }

        return view('office.supports.index', compact('office', 'data'));
    }

    public function show(Office $office, Support $support)
    {
        if ($support->supportable != $office) {
            abort(403);
        }
        return view('office.supports.show', compact('office', 'support'));
    }

    public function store_message(supportMessageRequest $request, Office $office, Support $support)
    {
        try {
            if ($support->supportable != $office) {
                abort(403);
            }
            $support->messages()->create([
                'sender' => 'user',
                'text'   => $request->input('message'),
            ]);

            $support->update([
                'status' => 'pending',
            ]);

            return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function create(Office $office)
    {
        return view('office.supports.create', compact('office'));
    }

    public function store(supportStoreRequest $request, Office $office)
    {
        try {
            $support = $office->supports()->create([
                'title' => $request->input('title'),
            ]);

            $support->messages()->create([
                'sender' => 'user',
                'text'   => $request->input('message'),
            ]);

            return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }


}
